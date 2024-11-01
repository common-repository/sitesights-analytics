<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_OwnerActions {

    public function __construct() {
        
        add_action("admin_enqueue_scripts", [$this, "initStatics"]);

    }

    public function initStatics($page) {
        
        if($page !== "settings_page_sitesights_settings" && $page !== "dashboard_page_sitesights_tracking_dashboard") {
            return;
        }

        wp_enqueue_style("sitesights-owner", SITESIGHTS_TRACKING_PLUGIN_URL . "statics/css/SiteSightsOwner.css", "", 
            filemtime(SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "statics/css/SiteSightsOwner.css"), "all");

        wp_enqueue_script("sitesights-owner", SITESIGHTS_TRACKING_PLUGIN_URL . "statics/js/SiteSightsOwner.js", "",
            filemtime(SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "statics/js/SiteSightsOwner.js"), true);

    }

}