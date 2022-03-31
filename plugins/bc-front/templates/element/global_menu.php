<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link			https://basercms.net baserCMS Project
 * @package         Baser.View
 * @since           baserCMS v 4.4.0
 * @license         https://basercms.net/license/index.html
 */

/**
 * サイトマップ
 * @var BcAppView $this
 */

/**
 * カテゴリの階層構造を表現する為、再帰呼び出しを行う
 * $this->BcBaser->contentsMenu() で呼び出す
 */

if (!isset($level)) {
	$level = 1;
}
if(!isset($currentId)) {
	$currentId = null;
}
?>


<?php if (isset($tree)): ?>
	<ul class="ul-level-<?php echo $level ?><?php echo ($level > 1) ? ' sub-group': ' bs-global-menu'?>">
		<?php if (isset($tree)): ?>
			<?php foreach ($tree as $content): ?>
				<?php if ($content->title): ?>
					<?php
					if(!empty($content->exclude_menu)) {
						continue;
					}
					$liClass = 'li-level-' . $level;
					if($content->id == $currentId || $this->BcBaser->isContentsParentId($currentId, $content->id)) {
						$liClass .= ' current';
					}
					$options = ['class' => 'bs-global-menu-item--link', 'escape' => true];
					if(!empty($content->blank_link)) {
						$options['target'] = '_blank';
					}
					?>
					<li class="bs-global-menu-item <?php echo $liClass ?>">
						<?php $this->BcBaser->link($content->title, $this->BcBaser->getContentsUrl($content->url, false, null, false), $options) ?>
						<?php if (!empty($content['children'])): ?>
							<div class="bs-global-menu-sub">
								<?php $this->BcBaser->element('contents_menu', ['tree' => $content['children'], 'level' => $level + 1, 'currentId' => $currentId]) ?>
							</div>
						<?php endif ?>
					</li>
				<?php endif ?>
			<?php endforeach; ?>
		<?php endif ?>
	</ul>
<?php endif ?>
