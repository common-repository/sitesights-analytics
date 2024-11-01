<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_Actions {

    public function __construct() {
        
        add_action("wp_enqueue_scripts", [$this, "initStatics"]);

    }

    public function initStatics() {

        $enableAdmin = get_option(SITESIGHTS_SETTINGS_KEY_ENABLED_ADMIN, false);

        if(!$enableAdmin && current_user_can("manage_options")) {
            return;
        }

        $enable = get_option(SITESIGHTS_SETTINGS_KEY_ENABLED, true);

        if(!$enable) {
            return;
        }

        $url = esc_url("https://app-static.sitesights.io/client.min.js");
        wp_enqueue_script("sitesights-tracking", $url, "", "2", false);

        wp_enqueue_script("sitesights-tracking-client", SITESIGHTS_TRACKING_PLUGIN_URL . "statics/js/Client.js", "",
            filemtime(SITESIGHTS_TRACKING_PLUGIN_DIRECTORY . "statics/js/Client.js"), false);

    }

}