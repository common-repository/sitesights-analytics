<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_Filters {

    public function __construct() {
        
        add_filter("script_loader_tag", [$this, "exchangeScriptOptions"], 10, 2);

    }

    public function exchangeScriptOptions($tag, $handle) {

        $prefix = "sitesights-";

        if(strncmp($handle, $prefix, strlen($prefix)) !== 0) {
            return $tag;
        }

        if($handle !== "sitesights-tracking") {
            return str_replace(" src", " defer src", $tag);
        }

        $wid = trim(get_option(SITESIGHTS_SETTINGS_KEY_WEBSITE_ID, ""));
        $args = "data-website-uid='" . $wid . "'";

        return str_replace(" src", " " . $args . " defer src", $tag);

    }

}