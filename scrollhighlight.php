<?php
    /*
     
    Plugin Name: Scroll Highlighter
    Description: Choose selector and highlight it on scoll
     
    */

    // create plugin settings menu
    add_action('admin_menu', 'scrollhighlight_create_menu');

    function scrollhighlight_create_menu() {
        add_menu_page('Scroll Highlighter', 'Scroll Highlighter', 'administrator', __FILE__, 'scrollhighlight_settings_page' , '');
        add_action( 'admin_init', 'register_scrollhighlight_settings_page' );
    }


    function register_scrollhighlight_settings_page() {
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_color' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_opacity' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_time' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_offset' );
    }

    function scrollhighlight_settings_page() { ?>
        <div class="wrap">
        <h1>Scroll Highlighter Setting</h1>
            <form method="post" action="options.php">
                
                <?php submit_button(); ?>
            </form>
        </div>
    <?php }