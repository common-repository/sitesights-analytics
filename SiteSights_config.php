<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

if(!defined("SITESIGHTS_TRACKING_PLUGIN_FILE")) {
	define("SITESIGHTS_TRACKING_PLUGIN_FILE", dirname( __FILE__ ) . "/sitesights-tracking.php");
}

if(!defined("SITESIGHTS_TRACKING_PLUGIN_BASENAME")) {
	define('SITESIGHTS_TRACKING_PLUGIN_BASENAME', plugin_basename(SITESIGHTS_TRACKING_PLUGIN_FILE));
}

if(!defined("SITESIGHTS_TRACKING_PLUGIN_DIRECTORY")) {
	define("SITESIGHTS_TRACKING_PLUGIN_DIRECTORY", plugin_dir_path(SITESIGHTS_TRACKING_PLUGIN_FILE));
}

if(!defined("SITESIGHTS_TRACKING_PLUGIN_URL")) {
	define("SITESIGHTS_TRACKING_PLUGIN_URL", plugin_dir_url(SITESIGHTS_TRACKING_PLUGIN_FILE));
}

//Admin pages

if(!defined("SITESIGHTS_PAGE_SETTINGS")) {
	define("SITESIGHTS_PAGE_SETTINGS", "sitesights_settings");
}

if(!defined("SITESIGHTS_PAGE_DASHBOARD")) {
	define("SITESIGHTS_PAGE_DASHBOARD", "sitesights_tracking_dashboard");
}

//Settings keys

if(!defined("SITESIGHTS_SETTINGS_KEY_WEBSITE_ID")) {
	define("SITESIGHTS_SETTINGS_KEY_WEBSITE_ID", "sitesights_tracking_website_id");
}

if(!defined("SITESIGHTS_SETTINGS_KEY_AVAILABLE")) {
	define("SITESIGHTS_SETTINGS_KEY_AVAILABLE", "sitesights_tracking_available");
}

if(!defined("SITESIGHTS_SETTINGS_KEY_URL")) {
	define("SITESIGHTS_SETTINGS_KEY_URL", "sitesights_tracking_url");
}

if(!defined("SITESIGHTS_SETTINGS_KEY_THEME")) {
	define("SITESIGHTS_SETTINGS_KEY_THEME", "sitesights_tracking_theme");
}

if(!defined("SITESIGHTS_SETTINGS_KEY_ENABLED")) {
	define("SITESIGHTS_SETTINGS_KEY_ENABLED", "sitesights_tracking_enabled");
}

if(!defined("SITESIGHTS_SETTINGS_KEY_ENABLED_ADMIN")) {
	define("SITESIGHTS_SETTINGS_KEY_ENABLED_ADMIN", "sitesights_tracking_enabled_admin");
}