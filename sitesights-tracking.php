<?php

/**
 * Plugin Name: SiteSights Analytics
 * Plugin URI: https://sitesights.io/
 * Description: Easy and privacy focused web analytics.
 * Author: Sitesights.io
 * Version: 1.1.0
 * License: Massachusetts Institute of Technology (MIT) license
 * License URI: https://opensource.org/licenses/MIT
 * Requires at least: 4.8
 * Tested up to: 6.4.2
 * Requires PHP: 5.6
 * Text Domain: sitesights-tracking
 * Domain Path: /languages
 */

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) { exit; }
define("SITESIGHTS_TRACKING_VERSION", "1.1.0");

require_once __DIR__ . "/SiteSights_config.php";
require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/SiteSights_Utils.php";

require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/SiteSights_OwnerFilters.php";
require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/SiteSights_OwnerActions.php";

require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/SiteSights_Filters.php";
require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/SiteSights_Actions.php";
require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/SiteSights_Cache.php";

require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/pages/SiteSights_Renderer.php";
require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/pages/SiteSights_OptionsPage.php";
require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/pages/SiteSights_DashboardPage.php";

require_once SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "common/SiteSights_Tracking.php";

$tracking = new SiteSights_Tracking();
$tracking->enable();
