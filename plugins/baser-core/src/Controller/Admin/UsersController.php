<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BaserCore\Controller\Admin;

use BaserCore\Model\Entity\User;
use BaserCore\Service\Admin\UsersAdminServiceInterface;
use BaserCore\Service\TwoFactorAuthenticationsServiceInterface;
use BaserCore\Service\UsersService;
use BaserCore\Service\UsersServiceInterface;
use BaserCore\Utility\BcSiteConfig;
use BaserCore\Utility\BcUtil;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\Routing\Router;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;
use BaserCore\Annotation\UnitTest;

/**
 * Class UsersController
 */
class UsersController extends BcAdminAppController
{

    /**
     * initialize
     *
     * ログインページ認証除外
     *
     * @return void
     * @checked
     * @unitTest
     * @noTodo
     */
    public function initialize(): void
    {
        parent::initialize();
        if($this->components()->has('Authentication')) {
            $this->Authentication->allowUnauthenticated(['login', 'login_code']);
        }
    }

    /**
     * 管理画面へログインする
     *
     * @param UsersAdminServiceInterface $service
     * @checked
     * @noTodo
     * @unitTest
     */
    public function login(UsersAdminServiceInterface $service)
    {
        $this->set($service->getViewVarsForLogin($this->getRequest()));
        $target = $this->Authentication->getLoginRedirect() ?? Configure::read('BcPrefixAuth.Admin.loginRedirect');

        // EVENT Users.beforeLogin
        $event = $this->dispatchLayerEvent('beforeLogin', [
            'user' => $this->request
        ]);
        if ($event !== false) {
            $this->request = ($event->getResult() === null || $event->getResult() === true)? $event->getData('user') : $event->getResult();
        }

        if ($this->request->is('post')) {
            $result = $this->Authentication->getResult();
            if ($result->isValid()) {
                $user = $result->getData();
                // EVENT Users.afterLogin
                $this->dispatchLayerEvent('afterLogin', [
                    'user' => $user,
                    'loginRedirect' => $target
                ]);
                $service->removeLoginKey($user->id);
                if ($this->request->is('https') && $this->request->getData('saved')) {
                    // 自動ログイン保存
                    $this->response = $service->setCookieAutoLoginKey($this->response, $user->id);
                }
                $this->BcMessage->setInfo(__d('baser_core', 'ようこそ、{0}さん。', $user->getDisplayName()));

                // baserCMS4系のパスワードでログインした場合、新しいハッシュアルゴリズムでパスワードをハッシュし直す
                if (Configure::read('BcApp.needsPasswordRehash') &&
                    $this->request->getAttribute('authentication')
                        ->identifiers()
                        ->get('Password')
                        ->needsPasswordRehash()
                ) {
                    try {
                        $password = $this->getRequest()->getData('password');
                        $service->update($user, [
                            'password_1' => $password,
                            'password_2' => $password
                        ]);
                    } catch (PersistenceFailedException) {
                        // バリデーションでパスワードの更新に失敗した場合はスルーする
                    }
                }

                return $this->redirect($target);
            } else {
                $this->BcMessage->setError(__d('baser_core', 'Eメール、または、パスワードが間違っています。'));
            }
        } else {
            $result = $this->Authentication->getResult();
            if ($result->isValid()) {
                return $this->redirect($target);
            }
        }
    }

    /**
     * 二段階認証コード入力
     *
     * @param UsersServiceInterface $usersService
     * @param TwoFactorAuthenticationsServiceInterface $twoFactorAuthenticationsServiceInterface
     */
    public function login_code(UsersServiceInterface $usersService, TwoFactorAuthenticationsServiceInterface $twoFactorAuthenticationsService)
    {
        $target = $this->Authentication->getLoginRedirect() ?? Router::url(Configure::read('BcPrefixAuth.Admin.loginRedirect'));

        $session = $this->request->getSession();

        // セッションの有効期限チェック
        $sessionDate = $session->read('TwoFactorAuth.Admin.date');
        if (!$sessionDate) {
            return $this->redirect(['action' => 'login']);
        }
        $expire = strtotime($sessionDate) + (Configure::read('BcApp.twoFactorAuthenticationCodeAllowTime') * 60);
        if ($expire < time()) {
            $this->BcMessage->setError(__d('baser_core', 'セッションの有効期限が切れました。'));
            return $this->redirect(['action' => 'login', '?' => $this->request->getQueryParams()]);
        }

        $userId = $session->read('TwoFactorAuth.Admin.user_id');
        $userEmail = $session->read('TwoFactorAuth.Admin.email');
        if (!$userId || !$userEmail) {
            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is('post')) {
            // 認証コード再送信
            if ($this->request->getData('resend')) {
                $twoFactorAuthenticationsService->send($userId, $userEmail);
                $this->BcMessage->setInfo(__d('baser_core', '認証コードを送信しました。'));
                return $this->render();
            }

            // 認証コードチェック
            if (!$twoFactorAuthenticationsService->verify($userId, $this->request->getData('code'))) {
                $this->BcMessage->setError(__d('baser_core', '認証コードが間違っているか有効期限切れです。'));
                return $this->render();
            }

            // ログイン
            $usersService->login($this->request, $this->response, $userId);
            $user = $usersService->get($userId);

            // EVENT Users.afterLogin
            $this->dispatchLayerEvent('afterLogin', [
                'user' => $user,
                'loginRedirect' => $target
            ]);

            // 自動ログイン保存
            $usersService->removeLoginKey($user->id);
            if ($this->request->is('https') && $session->read('TwoFactorAuth.Admin.saved')) {
                $this->response = $usersService->setCookieAutoLoginKey($this->response, $user->id);
            }

            $session->delete('TwoFactorAuth.Admin');

            $this->BcMessage->setInfo(__d('baser_core', 'ようこそ、{0}さん。', $user->getDisplayName()));
            return $this->redirect($target);
        }
    }

    /**
     * 代理ログイン
     *
     * 別のユーザにログインできる
     *
     * @param UsersServiceInterface $service
     * @param string|null
     * @return Response|void
     * @throws RecordNotFoundException When record not found.
     * @checked
     * @unitTest
     * @noTodo
     */
    public function login_agent(UsersServiceInterface $service, $id): ?Response
    {
        // 特権確認
        if (BcUtil::isAdminUser() === false) {
            throw new ForbiddenException();
        }
        // 既に代理ログイン済み
        if (BcUtil::isAgentUser()) {
            $this->BcMessage->setError(__d('baser_core', '既に代理ログイン中のため失敗しました。'));
            return $this->redirect(['action' => 'index']);
        }
        /* @var UsersService * $service */
        $service->loginToAgent($this->request, $this->response, $id, $this->referer());
        return $this->redirect($this->Authentication->getLoginRedirect() ?? Configure::read('BcPrefixAuth.Admin.loginRedirect'));
    }

    /**
     * 代理ログイン解除
     * @param UsersServiceInterface $service
     * @return Response
     * @unitTest
     * @noTodo
     * @checked
     */
    public function back_agent(UsersServiceInterface $service)
    {
        try {
            $redirectUrl = $service->returnLoginUserFromAgent($this->request, $this->response);
            $this->BcMessage->setInfo(__d('baser_core', '元のユーザーに戻りました。'));
            return $this->redirect($redirectUrl);
        } catch (\Exception $e) {
            $this->BcMessage->setError($e->getMessage());
            return $this->redirect($this->referer());
        }
    }

    /**
     * ログイン状態のセッションを破棄する
     *
     * @param UsersServiceInterface $service
     * @return void
     * @checked
     * @unitTest
     * @noTodo
     */
    public function logout(UsersServiceInterface $service)
    {
        // 代理ログインした場合、ログアウト前にセッションを削除する。
        if (BcUtil::isAgentUser()) {
            $session = $this->request->getSession();
            $session->delete('AuthAgent');
        }

        /* @var User $user */
        $user = $this->Authentication->getIdentity();
        $service->logout($this->request, $this->response, $user->id);
        $this->BcMessage->setInfo(__d('baser_core', 'ログアウトしました'));
        $this->redirect($this->Authentication->logout());
    }

    /**
     * ログインユーザーリスト
     *
     * 管理画面にログインすることができるユーザーの一覧を表示する
     *
     * @param UsersServiceInterface $service
     * @checked
     * @noTodo
     * @unitTest
     */
    public function index(UsersServiceInterface $service)
    {
        $this->setViewConditions('User', ['default' => ['query' => [
            'limit' => BcSiteConfig::get('admin_list_num'),
            'sort' => 'id',
            'direction' => 'asc',
        ]]]);

        // EVENT Users.searchIndex
        $event = $this->dispatchLayerEvent('searchIndex', [
            'request' => $this->request
        ]);
        if ($event !== false) {
            $this->request = ($event->getResult() === null || $event->getResult() === true)? $event->getData('request') : $event->getResult();
        }
        try {
            $entities = $this->paginate($service->getIndex($this->getRequest()->getQueryParams()));
        } catch (NotFoundException $e) {
            return $this->redirect(['action' => 'index']);
        }
        $this->set('users', $entities);
        $this->request = $this->request->withParsedBody($this->request->getQuery());
    }

    /**
     * ログインユーザー新規追加
     *
     * 管理画面にログインすることができるユーザーの各種情報を新規追加する
     *
     * @param UsersServiceInterface $service
     * @return Response|null|void
     * @checked
     * @noTodo
     * @unitTest
     */
    public function add(UsersAdminServiceInterface $service)
    {
        if ($this->request->is('post')) {

            // EVENT Users.beforeAdd
            $event = $this->dispatchLayerEvent('beforeAdd', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }

            try {
                $user = $service->create($this->request->getData());
                // EVENT Users.afterAdd
                $this->dispatchLayerEvent('afterAdd', [
                    'user' => $user
                ]);
                $this->BcMessage->setSuccess(__d('baser_core', 'ユーザー「{0}」を追加しました。', $user->getDisplayName()));
                return $this->redirect(['action' => 'edit', $user->id]);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $user = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。' . $e->getMessage()));
            }
        }
        $this->set($service->getViewVarsForAdd($user ?? $service->getNew()));
    }

    /**
     * ログインユーザー編集
     *
     * 管理画面にログインすることができるユーザーの各種情報を編集する
     *
     * @param UsersServiceInterface $service
     * @param string|null $id User id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     * @checked
     * @noTodo
     * @unitTest
     */
    public function edit(UsersAdminServiceInterface $service, $id = null)
    {
        if (!$id && empty($this->request->getData())) {
            $this->BcMessage->setError(__d('baser_core', '無効なIDです。'));
            $this->redirect(['action' => 'index']);
        }
        $user = $service->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->dispatchLayerEvent('beforeEdit', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }
            try {
                $user = $service->update($user, $this->request->getData());
                // EVENT Users.afterEdit
                $this->dispatchLayerEvent('afterEdit', [
                    'user' => $user
                ]);
                if ($service->isSelf($id)) {
                    $service->reLogin($this->request, $this->response);
                }
                $this->BcMessage->setSuccess(__d('baser_core', 'ユーザー「{0}」を更新しました。', $user->getDisplayName()));
                return $this->redirect(['action' => 'edit', $user->id]);
            } catch (PersistenceFailedException $e) {
                $user = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。') . $e->getMessage());
            }
        }
        $this->set($service->getViewVarsForEdit($user));
    }

    public function edit_password(UsersAdminServiceInterface $service)
    {
        $user = $service->get(BcUtil::loginUser()['id']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->dispatchLayerEvent('beforeEditPassword', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }
            try {
                $user = $service->updatePassword($user, $this->request->getData());
                $this->dispatchLayerEvent('afterEditPassword', [
                    'user' => $user
                ]);
                $service->reLogin($this->request, $this->response);
                $this->BcMessage->setSuccess(__d('baser_core', 'パスワードを更新しました。'));
                if ($this->request->getQuery('redirect')) {
                    $parsed = parse_url($this->request->getQuery('redirect'));
                    if (empty($parsed['host']) && empty($parsed['scheme'])) {
                        return $this->redirect(trim(BcUtil::siteUrl(), '/') . $this->request->getQuery('redirect'));
                    }
                }
                return $this->redirect(['action' => 'edit_password']);
            } catch (PersistenceFailedException $e) {
                $user = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。') . $e->getMessage());
            }
        }
        $this->set($service->getViewVarsForEdit($user));
    }

    /**
     * ログインユーザー削除
     *
     * 管理画面にログインすることができるユーザーを削除する
     *
     * @param UsersServiceInterface $service
     * @param string|null $id
     * @return Response|null|void
     * @throws RecordNotFoundException
     * @checked
     * @unitTest
     * @noTodo
     */
    public function delete(UsersServiceInterface $service, $id = null)
    {
        if (!$id) {
            $this->BcMessage->setError(__d('baser_core', '無効なIDです。'));
            $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $service->get($id);
        try {
            if ($service->delete($id)) {
                $this->BcMessage->setSuccess(__d('baser_core', 'ユーザー: {0} を削除しました。', $user->getDisplayName()));
            }
        } catch (Exception $e) {
            $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。') . $e->getMessage());
        }
        return $this->redirect(['action' => 'index']);
    }

}
