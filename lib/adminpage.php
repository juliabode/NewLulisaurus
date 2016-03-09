<?php

function merge_option_default_variables() {
  $options = get_option('plugin_options');

  $defaults = array(
    'lulisaurus_facebook_link'          => '',
    'lulisaurus_twitter_link'           => '',
    'lulisaurus_google_link'            => '',
    'lulisaurus_mail_link'              => '',
    'lulisaurus_xing_link'              => '',
    'lulisaurus_linkedin_link'          => '',
    'imprint_link_setting'          => '',
  );

  return wp_parse_args( $options, $defaults );
}

function create_theme_options_page() {
    // Global variable for Themes' settings page hook
    global $lulisaurus_settings_page;

    $lulisaurus_settings_page = add_menu_page('Optionen', 'Optionen', 'read', 'lulisaurus_settings', 'build_options_page', 'dashicons-lightbulb');

    // Add contextual help
    add_action( 'load-' . $lulisaurus_settings_page, 'add_contextual_theme_help' );
}
add_action('admin_menu', 'create_theme_options_page');


function build_options_page() { ?>
    <div id="theme-options-wrap" class="widefat wrap">
        <div class="icon32" id="icon-options-general"><br /></div>
        <h2>Zusätzliche Einstellungen</h2>
        <?php settings_errors(); ?>

        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php settings_fields('plugin_options'); ?>
            <?php do_settings_sections(__FILE__); ?>
            <p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
        </form>
    </div>
<?php }


function add_contextual_theme_help() {
    global $lulisaurus_settings_page;

    // Get the current screen object
    $screen = get_current_screen();

    $tabs = array(

    );

    foreach ( $tabs as $id => $data ) {
        $screen->add_help_tab( array(
            'id'       => $id,
            'title'    => __( $data['title'], 'root' ),
            'content'  => $data['content']
            )
        );
    }
}


function register_and_build_fields() {
  register_setting('plugin_options', 'plugin_options', 'validate_setting');

  add_settings_section('social_media_section', 'Social Media Links', 'section_cb', __FILE__);
  add_settings_field('lulisaurus_facebook_link', 'Facebook:', 'lulisaurus_facebook_link', __FILE__, 'social_media_section');
  add_settings_field('lulisaurus_twitter_link', 'Twitter:', 'lulisaurus_twitter_link', __FILE__, 'social_media_section');
  add_settings_field('lulisaurus_mail_link', 'Email:', 'lulisaurus_mail_link', __FILE__, 'social_media_section');
  add_settings_field('lulisaurus_xing_link', 'Xing:', 'lulisaurus_xing_link', __FILE__, 'social_media_section');
  add_settings_field('lulisaurus_linkedin_link', 'LinkedIn:', 'lulisaurus_linkedin_link', __FILE__, 'social_media_section');

  add_settings_section('main_section', 'Einstellungen für den Footer', 'section_cb', __FILE__);
  add_settings_field('imprint_link', 'Link zum Impressum:', 'imprint_link_setting', __FILE__, 'main_section');
}
add_action('admin_init', 'register_and_build_fields');

function validate_setting($plugin_options) { return $plugin_options; }

function section_cb() {}

function imprint_link_setting() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[lulisaurus_imprint_link]' type='text' value='{$options['lulisaurus_imprint_link']}' class='regular-text'/>";
}

function lulisaurus_facebook_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[lulisaurus_facebook_link]' type='text' value='{$options['lulisaurus_facebook_link']}' class='regular-text'/>";
}

function lulisaurus_twitter_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[lulisaurus_twitter_link]' type='text' value='{$options['lulisaurus_twitter_link']}' class='regular-text'/>";
}

function lulisaurus_mail_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[lulisaurus_mail_link]' type='text' value='{$options['lulisaurus_mail_link']}' class='regular-text'/>";
}

function lulisaurus_xing_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[lulisaurus_xing_link]' type='text' value='{$options['lulisaurus_xing_link']}' class='regular-text'/>";
}

function lulisaurus_linkedin_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[lulisaurus_linkedin_link]' type='text' value='{$options['lulisaurus_linkedin_link']}' class='regular-text'/>";
}
