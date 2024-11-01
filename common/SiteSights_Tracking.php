<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_Tracking {

    public function enable() {

        register_activation_hook(SITESIGHTS_TRACKING_PLUGIN_FILE, [$this, "onActivate"]);
        register_deactivation_hook(SITESIGHTS_TRACKING_PLUGIN_FILE, [$this, "onDeactivate"]);

        add_action("plugins_loaded", [$this, "onLoad"], 9);
        add_action("init", [$this, "onLoadTextDomain"]);

    }

    public function onLoad() {

        if(is_admin()) {

            new SiteSights_OwnerFilters();
            new SiteSights_OwnerActions();

            new SiteSights_OptionsPage();
            new SiteSights_DashboardPage();

        }

        new SiteSights_Cache();
        new SiteSights_Filters();
        new SiteSights_Actions();

    }

    public function onLoadTextDomain() {

        //load_plugin_textdomain("sitesights-tracking", false, dirname(SITESIGHTS_TRACKING_PLUGIN_BASENAME) . "/languages/");

    }

    public function onActivate($network_wide = false) {

        $settingsAvailable = get_option(SITESIGHTS_SETTINGS_KEY_AVAILABLE, false);

        if(!$settingsAvailable) {

            update_option(SITESIGHTS_SETTINGS_KEY_WEBSITE_ID, "");
            update_option(SITESIGHTS_SETTINGS_KEY_URL, "");
            update_option(SITESIGHTS_SETTINGS_KEY_THEME, "light");
            update_option(SITESIGHTS_SETTINGS_KEY_ENABLED_ADMIN, false);
            update_option(SITESIGHTS_SETTINGS_KEY_ENABLED, true);

            update_option(SITESIGHTS_SETTINGS_KEY_AVAILABLE, true);

        }

    }

    public function onDeactivate() {

        //nothing needed here

    }

}