<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_Cache {

    public function __construct() {
        
        if(defined("LSCWP_V")) {
			add_filter("litespeed_optimize_js_excludes", [$this, 'excludeByUrls']);
		}

        if(defined("\SiteGround_Optimizer\VERSION")) {
			add_filter("sgo_javascript_combine_exclude", [$this, 'excludeByHandle']);
			add_filter("sgo_js_minify_exclude", [$this, 'excludeByHandle']);
			add_filter("sgo_js_async_exclude", [$this, 'excludeByHandle']);
			add_filter("sgo_javascript_combine_excluded_external_paths", [$this, 'excludeByUrls']);
		}

        if(defined("WP_ROCKET_VERSION")) {
			add_filter("rocket_exclude_js", [$this, 'excludeByUrls']);
			add_filter("rocket_minify_excluded_external_js", [$this, 'excludeByUrls']);
			add_filter("rocket_delay_js_scripts", [$this, 'excludeByUrls']);
		}

        if(defined("WPO_VERSION")) {
			add_filter("wp-optimize-minify-default-exclusions", [$this, 'excludeByUrls']);
		}

        if(defined("AUTOPTIMIZE_PLUGIN_VERSION")) {
			add_filter("autoptimize_filter_js_exclude", [$this, 'excludeByString']);
		}

    }

    public function excludeByHandle($exclude_list) {

		$exclude_list[] = "sitesights-tracking-client";
        $exclude_list[] = "sitesights-tracking";

		return $exclude_list;

	}

	public function excludeByString($exclude_text) {

		$exclude_text .= ", " . esc_url("https://app-static.sitesights.io/client.min.js");
        $exclude_text .= ", " . esc_url(SITESIGHTS_TRACKING_PLUGIN_URL . "statics/js/Client.js");
        $exclude_text .= ", " . SITESIGHTS_TRACKING_PLUGIN_URL . "statics/js/Client.js";

		return $exclude_text;

	}

	public function excludeByUrls($exclude_list) {

		$exclude_list[] = esc_url("https://app-static.sitesights.io/client.min.js");
        $exclude_list[] = esc_url(SITESIGHTS_TRACKING_PLUGIN_URL . "statics/js/Client.js");
        $exclude_list[] = SITESIGHTS_TRACKING_PLUGIN_URL . "statics/js/Client.js";

		return $exclude_list;

	}

}