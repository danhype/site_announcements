<?php
/**
 * mark an announcement as read
 */

$guid = (int) get_input("guid");

if (empty($guid)) {
	return elgg_error_response(elgg_echo('InvalidParameterException:MissingParameter'));
}

$entity = get_entity($guid);
if (!$entity instanceof \ColdTrick\SiteAnnouncements\SiteAnnouncement) {
	return elgg_error_response(elgg_echo('InvalidParameterException:NoEntityFound'));
}

if (elgg_is_logged_in()) {
	// logged in user are different from logged out users
	$entity->markAsRead();
	return elgg_ok_response();
}

$guids = [];
if (isset($_COOKIE['site_announcements'])) {
	$guids = string_to_tag_array($_COOKIE['site_announcements']);
}

$guids[] = $entity->getGUID();
$expire = time() + (30 * 24 * 60 * 60); // in 30 days
setcookie(site_announcements, implode(",", $guids), $expire, "/");

return elgg_ok_response();