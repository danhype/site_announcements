<?php

use ColdTrick\SiteAnnouncements\Bootstrap;
use ColdTrick\SiteAnnouncements\Gatekeeper;

return [
	'bootstrap' => Bootstrap::class,
	'entities' => [
		[
			'type' => 'object',
			'subtype' => 'site_announcement',
			'class' => \SiteAnnouncement::class,
		],
	],
	'routes' => [
		'action:site_announcements:edit' => [
			'path' => '/action/site_announcements/edit',
			'file' => __DIR__ . '/actions/site_announcements/edit.php',
			'middleware' => [
				Gatekeeper::class,
			]
		],
		'add:object:site_announcement' => [
			'path' => '/announcements/add/{guid?}',
			'resource' => 'site_announcements/add',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'edit:object:site_announcement' => [
			'path' => '/announcements/edit/{guid}',
			'resource' => 'site_announcements/edit',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'collection:object:site_announcement:archive' => [
			'path' => '/announcements/archive',
			'resource' => 'site_announcements/archive',
		],
		'collection:object:site_announcement:scheduled' => [
			'path' => '/announcements/scheduled',
			'resource' => 'site_announcements/scheduled',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'collection:object:site_announcement:editors' => [
			'path' => '/announcements/editors',
			'resource' => 'site_announcements/editors',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'collection:object:site_announcement:all' => [
			'path' => '/announcements/all',
			'resource' => 'site_announcements/all',
		],
		'default:object:site_announcement' => [
			'path' => '/announcements',
			'resource' => 'site_announcements/all',
		],
	],
	'actions' => [
		'site_announcements/mark' => ['access' => 'public'],
		'site_announcements/toggle_editor' => ['access' => 'admin'],
	],
];
