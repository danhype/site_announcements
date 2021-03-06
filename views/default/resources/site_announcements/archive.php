<?php
/**
 * List all past announcements
 */

use ColdTrick\SiteAnnouncements\Gatekeeper;

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);
elgg_push_breadcrumb(elgg_echo('site_announcements:archive'));

// add button
if (Gatekeeper::isEditor()) {
	elgg_register_title_button('announcements', 'add', 'object', \SiteAnnouncement::SUBTYPE);
}

// build page elements
$title = elgg_echo('site_announcements:archive:title');

$content = elgg_list_entities([
	'type' => 'object',
	'subtype' => \SiteAnnouncement::SUBTYPE,
	'order_by_metadata' => [
		'name' => 'enddate',
		'as' => 'integer',
		'direction' => 'DESC',
	],
	'metadata_name_value_pairs' => [
		[
			'name' => 'enddate',
			'value' => time(),
			'operand' => '<',
		],
	],
	'no_results' => elgg_echo('site_announcements:archive:none'),
]);

// build page
$page_data = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'sidebar' => false,
	'filter_id' => 'site_announcements',
]);

// draw page
echo elgg_view_page($title, $page_data);
