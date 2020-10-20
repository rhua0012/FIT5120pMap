<?php defined('ABSPATH') or die("No script kiddies please!"); ?>

<div id="wpbody" role="main">

    <div id="wpbody-content" aria-label="Main content" tabindex="0">
        <div class="wrap est-wrap">
            <div class="est-header-wrap">
                <h3><span class="est-admin-title">How to use</span></h3>
                <div class="logo">
                    <img src="<?php echo EST_IMAGE_DIR; ?>/logo.png" alt="<?php esc_attr_e('Easy Side Tab', 'easy-side-tab'); ?>">
                </div>
            </div>
            <div class="est-form-wrap">
                <div class="est-content-wrap">
                    <div class="est-content-section">
                        <?php _e('<h5 class="description">For detailed documentation, please visit <a href="https://accesspressthemes.com/documentation/easy-side-tab/" target="_blank">here</a>.</h5>','easy-side-tab'); ?>

                        <?php _e('<h4 class="est-content-title">Create new gallery</h4>','easy-side-tab'); ?>
                        <?php _e('<p>In this section you can change the settings of the tab such as:</p>','easy-side-tab'); ?>
                        <ul>
                            <li><?php _e('<strong>Tab Title</strong> -Here,  you should assign  the name for your tab.','easy-side-tab'); ?></li>
                            <li><?php _e('<strong>Tab Text</strong> - In this section you should input the name which is to be displayed on the tab.','easy-side-tab'); ?></li>
                            <li><?php _e('<strong>Tab Type</strong> - This field determines the type of tab that you are going to display on your    website which are as:','easy-side-tab'); ?>
                                <ul>
                                    <li><?php _e('<strong>Internal</strong> -This field comes with a option to redirect to the internal page of your website.','easy-side-tab'); ?></li>
                                    <li><?php _e('<strong>External </strong> -This field has a URL field where you should give the external link url (eg:https://www.google.com).','easy-side-tab'); ?></li>
                                    <li><?php _e('<strong>Content Slider</strong> -Under this field there is a field where you write content so that content will be displayed on tab click.','easy-side-tab'); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="est-content-section">
                        <?php _e('<h4 class="est-content-title">Layout Settings.</h4>','easy-side-tab'); ?>
                        <?php _e('<h5>Tab Layout</h5>','easy-side-tab'); ?>
                        <?php _e('<p>With this option you can choose the template layout designs as you desire.</p>','easy-side-tab'); ?>

                        <?php _e('<h5>Display Position</h5>','easy-side-tab'); ?>
                        <?php _e('<p>This section determines whether you want the tab position to be fixed when the page is scrolled or absolute(ie. move when the page is scrolled) on your website.</p>','easy-side-tab'); ?>

                        <?php _e('<h5>Customize Setting</h5>','easy-side-tab'); ?>
                        <?php _e('<p>With this option selected you can choose the desired colors for your tab such as background color, text color, background hover color, text hover color, slider content background and text color.</p>','easy-side-tab'); ?>
                    </div>
                    <div class="est-content-section">
                        <?php _e('<h4 class="est-content-title">Side Tab General Settings</h4>','easy-side-tab'); ?>
                        <?php _e('<p>This is the main control of our plugin where you get the option for:</p>','easy-side-tab'); ?>
                        <ul>
                            <li><?php _e('<strong>Enable Side Tab</strong> -Switching the Tab on or off on your website.','easy-side-tab'); ?></li>
                            <li><?php _e('<strong>Enable On Mobile Devices</strong> -Enable or disable the plugin for mobile device.','easy-side-tab'); ?></li>
                            <li><?php _e('<strong>Tab Position</strong> -Select the position of the tab ie left or right.','easy-side-tab'); ?></li>
                            <li><?php _e('<strong>Display Pages</strong> -Option whether to display tab on homepage or all pages.','easy-side-tab'); ?></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div><!-- wpbody-content -->
    
    <div class="clear"></div>
</div>