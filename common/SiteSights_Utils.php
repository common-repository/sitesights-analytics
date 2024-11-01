<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_Utils {

    public static function getDefaultDomain() {

        $home = home_url();
        $parsed = parse_url($home);

        return $parsed["host"];

    }

}