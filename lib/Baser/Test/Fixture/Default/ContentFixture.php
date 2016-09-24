<?php
/**
 * ContentFixture
 */
class ContentFixture extends BaserTestFixture {

/**
 * Name of the object
 *
 * @var string
 */
	public $name = 'Content';
	
/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'site_id' => '0',
			'name' => '',
			'plugin' => 'Core',
			'type' => 'ContentFolder',
			'url' => '/',
			'parent_id' => null,
			'lft' => '1',
			'rght' => '40',
			'title' => 'baserCMS inc. [デモ]',
			'status' => 1,
			'created' => '2016-07-29 18:02:53',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => null,
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:04:23',
			'entity_id' => '1',
			'alias_id' => null,
			'site_root' => 1,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => 'default',
			'main_site_content_id' => null,
			'level' => 0,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '2',
			'site_id' => '1',
			'name' => 'm',
			'plugin' => 'Core',
			'type' => 'ContentFolder',
			'url' => '/m/',
			'parent_id' => '1',
			'lft' => '2',
			'rght' => '9',
			'title' => 'baserCMS inc.｜ケータイ',
			'status' => 1,
			'created' => '2016-07-29 18:02:53',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => null,
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:04:23',
			'entity_id' => '2',
			'alias_id' => null,
			'site_root' => 1,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => 'default',
			'main_site_content_id' => '1',
			'level' => 1,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '3',
			'site_id' => '2',
			'name' => 's',
			'plugin' => 'Core',
			'type' => 'ContentFolder',
			'url' => '/s/',
			'parent_id' => '1',
			'lft' => '10',
			'rght' => '25',
			'title' => 'baserCMS inc.｜スマホ',
			'status' => 1,
			'created' => '2016-07-29 18:02:53',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => null,
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:04:23',
			'entity_id' => '3',
			'alias_id' => null,
			'site_root' => 1,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => 'default',
			'main_site_content_id' => '1',
			'level' => 1,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '4',
			'site_id' => '0',
			'name' => 'index',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/index',
			'parent_id' => '1',
			'lft' => '26',
			'rght' => '27',
			'title' => 'トップページ',
			'status' => 1,
			'created' => '2016-07-29 18:13:03',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:13:03',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-08-03 23:30:16',
			'entity_id' => '1',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => null,
			'level' => 1,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '5',
			'site_id' => '0',
			'name' => 'about',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/about',
			'parent_id' => '1',
			'lft' => '28',
			'rght' => '29',
			'title' => '会社案内',
			'status' => 1,
			'created' => '2016-07-29 18:13:56',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:13:55',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-08-03 23:49:22',
			'entity_id' => '2',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => null,
			'level' => 1,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '6',
			'site_id' => '0',
			'name' => 'service',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/service',
			'parent_id' => '1',
			'lft' => '30',
			'rght' => '31',
			'title' => 'サービス',
			'status' => 1,
			'created' => '2016-07-29 18:14:33',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:14:33',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:14:54',
			'entity_id' => '3',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => null,
			'level' => 1,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '7',
			'site_id' => '0',
			'name' => 'icons',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/icons',
			'parent_id' => '1',
			'lft' => '32',
			'rght' => '33',
			'title' => 'アイコンの使い方',
			'status' => 1,
			'created' => '2016-07-29 18:15:14',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:15:14',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:15:29',
			'entity_id' => '4',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => null,
			'level' => 1,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '8',
			'site_id' => '0',
			'name' => 'sitemap',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/sitemap',
			'parent_id' => '1',
			'lft' => '34',
			'rght' => '35',
			'title' => 'サイトマップ',
			'status' => 1,
			'created' => '2016-07-29 18:15:50',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:15:50',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:16:20',
			'entity_id' => '5',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => null,
			'level' => 1,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '9',
			'site_id' => '1',
			'name' => 'index',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/m/index',
			'parent_id' => '2',
			'lft' => '3',
			'rght' => '4',
			'title' => 'トップページ',
			'status' => 1,
			'created' => '2016-07-29 18:18:06',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:18:05',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:19:05',
			'entity_id' => '6',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '4',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '10',
			'site_id' => '2',
			'name' => 'index',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/s/index',
			'parent_id' => '3',
			'lft' => '11',
			'rght' => '12',
			'title' => 'トップページ',
			'status' => 1,
			'created' => '2016-07-29 18:19:54',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:19:54',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:22:39',
			'entity_id' => '7',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '4',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '11',
			'site_id' => '2',
			'name' => 'about',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/s/about',
			'parent_id' => '3',
			'lft' => '13',
			'rght' => '14',
			'title' => '会社案内',
			'status' => 1,
			'created' => '2016-07-29 18:20:19',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:20:18',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:22:21',
			'entity_id' => '8',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '5',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '12',
			'site_id' => '2',
			'name' => 'service',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/s/service',
			'parent_id' => '3',
			'lft' => '15',
			'rght' => '16',
			'title' => 'サービス',
			'status' => 1,
			'created' => '2016-07-29 18:20:35',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:20:35',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:22:05',
			'entity_id' => '9',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '6',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '13',
			'site_id' => '2',
			'name' => 'icons',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/s/icons',
			'parent_id' => '3',
			'lft' => '17',
			'rght' => '18',
			'title' => 'アイコンの使い方',
			'status' => 1,
			'created' => '2016-07-29 18:20:50',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:20:50',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:21:49',
			'entity_id' => '10',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '7',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '14',
			'site_id' => '2',
			'name' => 'sitemap',
			'plugin' => 'Core',
			'type' => 'Page',
			'url' => '/s/sitemap',
			'parent_id' => '3',
			'lft' => '19',
			'rght' => '20',
			'title' => 'サイトマップ',
			'status' => 1,
			'created' => '2016-07-29 18:21:04',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-29 18:21:04',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-29 18:21:31',
			'entity_id' => '11',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '8',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '15',
			'site_id' => '0',
			'name' => 'contact',
			'plugin' => 'Mail',
			'type' => 'MailContent',
			'url' => '/contact',
			'parent_id' => '1',
			'lft' => '36',
			'rght' => '37',
			'title' => 'お問い合わせ',
			'status' => 1,
			'created' => '2016-07-30 21:51:49',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-30 21:51:49',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-30 21:53:22',
			'entity_id' => '1',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => null,
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '16',
			'site_id' => '0',
			'name' => 'news',
			'plugin' => 'Blog',
			'type' => 'BlogContent',
			'url' => '/news',
			'parent_id' => '1',
			'lft' => '38',
			'rght' => '39',
			'title' => '新着情報',
			'status' => 1,
			'created' => '2016-07-31 15:01:41',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-31 15:01:41',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-31 15:02:16',
			'entity_id' => '1',
			'alias_id' => null,
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => null,
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '17',
			'site_id' => '1',
			'name' => 'contact',
			'plugin' => 'Mail',
			'type' => 'MailContent',
			'url' => '/m/contact',
			'parent_id' => '2',
			'lft' => '5',
			'rght' => '6',
			'title' => 'お問い合わせ',
			'status' => 1,
			'created' => '2016-07-31 16:46:32',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-31 16:46:32',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-31 16:46:39',
			'entity_id' => '1',
			'alias_id' => '15',
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '15',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '18',
			'site_id' => '2',
			'name' => 'contact',
			'plugin' => 'Mail',
			'type' => 'MailContent',
			'url' => '/s/contact',
			'parent_id' => '3',
			'lft' => '21',
			'rght' => '22',
			'title' => 'お問い合わせ',
			'status' => 1,
			'created' => '2016-07-31 16:46:47',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-31 16:46:47',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-31 16:46:55',
			'entity_id' => '1',
			'alias_id' => '15',
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '15',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '19',
			'site_id' => '1',
			'name' => 'news',
			'plugin' => 'Blog',
			'type' => 'BlogContent',
			'url' => '/m/news',
			'parent_id' => '2',
			'lft' => '7',
			'rght' => '8',
			'title' => '新着情報',
			'status' => 1,
			'created' => '2016-07-31 16:47:04',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-31 16:47:04',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-31 16:47:14',
			'entity_id' => '1',
			'alias_id' => '16',
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '16',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
		array(
			'id' => '20',
			'site_id' => '2',
			'name' => 'news',
			'plugin' => 'Blog',
			'type' => 'BlogContent',
			'url' => '/s/news',
			'parent_id' => '3',
			'lft' => '23',
			'rght' => '24',
			'title' => '新着情報',
			'status' => 1,
			'created' => '2016-07-31 16:47:21',
			'description' => '',
			'eyecatch' => '',
			'author_id' => '1',
			'created_date' => '2016-07-31 16:47:21',
			'modified_date' => null,
			'publish_begin' => null,
			'publish_end' => null,
			'exclude_search' => 0,
			'modified' => '2016-07-31 16:47:26',
			'entity_id' => '1',
			'alias_id' => '16',
			'site_root' => 0,
			'deleted_date' => null,
			'deleted' => 0,
			'layout_template' => '',
			'main_site_content_id' => '16',
			'level' => 2,
			'self_status' => 1,
			'self_publish_begin' => null,
			'self_publish_end' => null,
			'exclude_menu' => 0,
			'blank_link' => 0
		),
	);

}
