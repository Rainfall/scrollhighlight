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
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_selector' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_color' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_opacity' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_time' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_offset_type' );
        register_setting( 'scrollhighlight-settings-group', 'scrollhighlight_offset' );
    }

    function scrollhighlight_settings_page() { ?>
        <div class="wrap scrollhighlight-wrap">
            <h1>Scroll Highlighter Setting</h1>
            <div class="scrollhighlight-inner flexed">
                <form method="post" action="options.php">
                    <?php settings_fields( 'scrollhighlight-settings-group' ); ?>
                    <?php do_settings_sections( 'scrollhighlight-settings-group' ); ?>
                    <label>
                        <span>CSS Selector. Put a valid selector of the element to highlight. Ex: .my-element Or: #someelement</span>
                        <input type="text" required name="scrollhighlight_selector" value="<?php echo esc_attr( get_option('scrollhighlight_selector') ); ?>">
                    </label>
                    <label>
                        <span>Overlay Background Color</span>
                        <input type="color" required name="scrollhighlight_color" value="<?php echo esc_attr( get_option('scrollhighlight_color') ); ?>" />
                    </label>
                    <label>
                        <span>Overlay Background Opacity</span>
                        <input type="number" required name="scrollhighlight_opacity" min="0" max="100" step="1" value="<?php echo esc_attr( get_option('scrollhighlight_opacity') ); ?>" />
                    </label>
                    <label>
                        <span>Overlay Visibility Time in seconds. Put 0 for keeping overlay until scrolling away.</span>
                        <input type="number" required name="scrollhighlight_time" min="0" max="100" step="1" value="<?php echo esc_attr( get_option('scrollhighlight_time') ); ?>" />
                    </label>
                    <label>
                        <span>To trigger when element is</span>
                        <select name="scrollhighlight_offset_type"  required>
                            <option value="top" <?php echo get_option('scrollhighlight_offset_type') == 'top' ? 'selected' : ''; ?>>
                                At the top of the page
                            </option>
                            <option value="center" <?php echo get_option('scrollhighlight_offset_type') == 'center' ? 'selected' : ''; ?>>
                                At the center of the page
                            </option>
                            <option value="bottom" <?php echo get_option('scrollhighlight_offset_type') == 'bottom' ? 'selected' : ''; ?>>
                                At the bottom of the Page
                            </option>
                        </select>
                    </label>
                    <label>
                        <span>With offset of</span>
                        <span class="flexed">
                            <input type="number" required name="scrollhighlight_offset" value="<?php echo esc_attr(get_option('scrollhighlight_offset')); ?>">
                            <span>px</span>
                        </span>
                    </label>
                    <?php submit_button(); ?>
                </form>
                <div class="scrollhighlight-preview">
                    <?php if (get_option('scrollhighlight_selector') != '') { ?>
                    <div class="scorllheight-preview-element">
                        <div class="scorllheight-preview-main scrollhighlight-position-<?php echo get_option('scrollhighlight_offset_type'); ?>">
                            <div class="scorllheight-preview-text">
                                
                            </div>
                            <div class="scorllheight-preview-main-element">
                                <?php echo get_option('scrollhighlight_selector'); ?>
                            </div>
                            <div class="scorllheight-preview-text">
                                
                            </div>
                        </div>
                        <div class="scorllheight-preview-aside"></div>
                        <div class="scorllheight-preview-overlay" style="background: <?php echo get_option('scrollhighlight_color'); ?>;opacity: <?php echo get_option('scrollhighlight_opacity'); ?>%"></div>
                    </div>
                    <?php } else { ?>
                        <h2>Save settings to load preview.</h2>
                    <?php } ?>
                </div>
            </div>
            
        </div>

        <style>
            .scrollhighlight-wrap label {
                display: block;
                margin-bottom: 20px;
            }

            .scrollhighlight-wrap h1 {
                margin-bottom: 20px;
            }

            .scrollhighlight-wrap label > span {
                display: block;
            }
            .scrollhighlight-inner {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .scrollhighlight-preview h2 {
                text-align: center;
            }

            .scrollhighlight-preview {
                width: 400px;
            }

            .scorllheight-preview-element {
                display: flex;
                justify-content: space-between;
                position: relative;
                background: #fff;
            }

            .scorllheight-preview-aside {
                width: 100px;
                background: #999;
                border-radius: 10px;
                height: 200px;
            }

            .scorllheight-preview-overlay {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                z-index: 2;
            }

            .scorllheight-preview-text {
                width: 250px;
                background: #999;
                height: 20px;
                border-radius: 10px;
                position: relative;
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .scorllheight-preview-text:before {
                content: '';
                position: absolute;
                height: 18px;
                width: 100px;
                bottom: calc(100% + 7px);
                background: #999;
                border-radius: 10px;
            }

            .scorllheight-preview-text:after {
                content: '';
                position: absolute;
                height: 18px;
                width: 170px;
                top: calc(100% + 7px);
                background: #999;
                border-radius: 10px;
            }

            .scorllheight-preview-main-element {
                background: #fff;
                border-radius: 10px;
                position: relative;
                z-index: 10;
                padding: 10px;
                margin: 10px 0;
                border: 2px solid #999;
            }
            
            .scorllheight-preview-main.scrollhighlight-position-bottom,
            .scorllheight-preview-main.scrollhighlight-position-top {
                display: flex;
                flex-direction: column;
            }

            .scorllheight-preview-main.scrollhighlight-position-top .scorllheight-preview-main-element {
                order: -1;
            }

            .scorllheight-preview-main.scrollhighlight-position-bottom .scorllheight-preview-text {
                order: -1;
            }
        </style>
    <?php }