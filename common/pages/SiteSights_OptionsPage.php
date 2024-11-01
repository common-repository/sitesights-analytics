<?php

namespace SiteSights\Tracking\WP;

if(!defined("ABSPATH")) {
	exit;
}

class SiteSights_OptionsPage extends SiteSights_Renderer {

    public function __construct() {
        
        add_action("admin_menu", [$this, "init"]);

    }

    public function init() {

        $requiredCapability = "manage_options";

        add_options_page("SiteSights Options", "SiteSights Options", $requiredCapability, 
            SITESIGHTS_PAGE_SETTINGS, [$this, "render"]);

    }

    public function onSave() {

        if(isset($_POST["sitesights-uid"]))
            update_option(SITESIGHTS_SETTINGS_KEY_WEBSITE_ID, sanitize_text_field($_POST["sitesights-uid"]));

        if(isset($_POST["sitesights-share-url"]))
            update_option(SITESIGHTS_SETTINGS_KEY_URL, sanitize_text_field($_POST["sitesights-share-url"]));

        if(isset($_POST["sitesights-theme"]))
            update_option(SITESIGHTS_SETTINGS_KEY_THEME, $_POST["sitesights-theme"] == "light" ? "light" : "dark");
        
        update_option(SITESIGHTS_SETTINGS_KEY_ENABLED_ADMIN, isset($_POST["sitesights-enabled-admin"]));
        update_option(SITESIGHTS_SETTINGS_KEY_ENABLED, isset($_POST["sitesights-enabled"]));

    }

    public function render() {

        if(isset($_POST["sitesights_options_nonce"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["sitesights_options_nonce"])), "sitesights_options_form")) {
            if(isset($_POST["sitesights-uid"])) {
                $this->onSave();
            }
        }

        $link = get_option(SITESIGHTS_SETTINGS_KEY_URL, "");
        $theme = get_option(SITESIGHTS_SETTINGS_KEY_THEME, "light");
        $wid = get_option(SITESIGHTS_SETTINGS_KEY_WEBSITE_ID, "");

        $enable = get_option(SITESIGHTS_SETTINGS_KEY_ENABLED, true);
        $adminEnable = get_option(SITESIGHTS_SETTINGS_KEY_ENABLED_ADMIN, false);

        ?> <form id="sitesights-settings-form" method="post"><div class="sitesights-main"> <?php

        $this->renderHeader();
        ?>
            <?php wp_nonce_field('sitesights_options_form', 'sitesights_options_nonce') ?>
            <div class="sitesights-stages">
                <div class="sitesights-stage dashboard">
                    <div class="sitesights-title">
                        Website ID
                    </div>
                    <div class="sitesights-content">
                        <div class="sitesights-help">
                            In order for the tracking to work, you need to enter the Website ID from
                            <a href="https://app.sitesights.io/websites" target="_blank">sitesights.io</a> under <strong>Websites</strong> > <strong>Edit Website</strong>.
                        </div>
                        <div class="sitesights-input">
                            <input value="<?php echo esc_attr($wid) ?>" type="text" maxlength="300" id="sitesights-uid" name="sitesights-uid" placeholder="Example: 8WK_Jz8b00SMgqm8pBZcCg" />
                        </div>
                    </div>
                </div>
                <div class="sitesights-stage dashboard">
                    <div class="sitesights-title">
                        Setup your Dashboard for WordPress
                    </div>
                    <div class="sitesights-content">
                        <div class="sitesights-help">
                            If you want to embed your analytics dashboard in WordPress itself. You need to enable
                            the public sharing site in your website settings on <a href="https://app.sitesights.io/websites" target="_blank">sitesights.io</a> under <strong>Websites</strong> > <strong>Edit Website</strong>.
                            After enabling, you need to paste the share url down below.
                        </div>
                        <div class="sitesights-input">
                            <input value="<?php echo esc_url($link) ?>" type="text" maxlength="300" id="sitesights-share-url" name="sitesights-share-url" placeholder="Example: https://app.sitesights.io/share?id=YYY" />
                        </div>
                        <div class="sitesights-title sub">
                            Dashboard Theme
                        </div>
                        <div class="sitesights-radios">
                            <input type="radio" id="sitesights-light" name="sitesights-theme" value="light" <?php echo $theme == "light" ? "checked" : "" ?> >
                            <label for="sitesights-light">Light</label>
                            <input type="radio" id="sitesights-dark" name="sitesights-theme" value="dark" <?php echo $theme == "dark" ? "checked" : "" ?> >
                            <label for="sitesights-dark">Dark</label>
                        </div>
                    </div>
                </div>
                <div class="sitesights-stage enable">
                    <div class="sitesights-title">
                        Enable/Disable tracking
                    </div>
                    <div class="sitesights-content">
                        <div class="sitesights-help">
                            Control if and for who tracking should be enabled.
                        </div>
                        <div class="sitesights-inputs">
                            <label class="sitesights-checkbox">
                                <input type="checkbox" id="sitesights-enabled" name="sitesights-enabled" <?php echo !$enable ? "" : "checked" ?> >Enabled
                                <span class="mark"></span>
                            </label>
                            <label class="sitesights-checkbox">
                                <input type="checkbox" id="sitesights-enabled-admin" name="sitesights-enabled-admin" <?php echo !$adminEnable ? "" : "checked" ?> >Track admins
                                <span class="mark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" form="sitesights-settings-form">Save</button>
        <?php

        ?> </div></form> <?php

    }

}
