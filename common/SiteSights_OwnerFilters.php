<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_OwnerFilters {

    public function __construct() {
        
        add_filter("plugin_action_links_" . SITESIGHTS_TRACKING_PLUGIN_BASENAME, [$this, "addPluginActions"]);

    }

    public function addPluginActions($actions) {

        $add = [
            "options" 
                => "<a href='" . admin_url("admin.php?page=" . SITESIGHTS_PAGE_SETTINGS) . "'>Options</a>",
            "documentation"
                => "<a href='" . esc_url_raw("https://docs.sitesights.io/plugins/wordpress") . "' target='_blank'>Documentation</a>",
        ];

        return array_merge($add, $actions);

    }

}