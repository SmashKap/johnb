<?php

/**
 * Theme Functions
 **/
require_once dirname( __FILE__ ) . '/lib/kirki/kirki.php';

// customizer controls
require_once dirname( __FILE__ ) . '/lib/customizer-controls/editor/editor-control.php';
require_once dirname( __FILE__ ) . '/lib/customizer-controls/editor/editor-page.php';

load_template( trailingslashit( get_template_directory() ) . 'includes/theme-functions.php' );

function onetone_register_options(){
	require_once  dirname( __FILE__ ) . '/includes/options.php';
	}
add_action( 'init', 'onetone_register_options' );

global $onetone_options_saved, $onetone_old_version, $onetone_option_name, $onetone_model_v;
$onetone_options_saved = false;
$onetone_old_version   = false;
$onetone_model_v       = false;
$onetone_option_name   = onetone_option_name();

if ( $theme_options = get_option($onetone_option_name) ) {
	
$onetone_options_saved = true;
if( (isset($theme_options['section_content_0']) && $theme_options['section_content_0'] != '') &&
	(isset($theme_options['section_content_1']) && $theme_options['section_content_0'] != '') &&
	(isset($theme_options['section_content_2']) && $theme_options['section_content_0'] != '') ){
	
	$onetone_old_version = true;
}
if( isset($theme_options['section_content_model_0']) ||
	isset($theme_options['section_content_model_1']) ||
	isset($theme_options['section_content_model_2']) ||
	isset($theme_options['section_content_model_3']) ){
	$onetone_model_v = true;
}

}

/**
 * Theme setup
 **/
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-setup.php' );


/**
 * Theme widget
 **/
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-widget.php' );



/**
 * Check OneTone Companion installation
 */
function onetone_companion_check() {

	if ( !file_exists( ABSPATH . 'wp-content/plugins/onetone-companion/onetone-companion.php' )  || !is_plugin_active('onetone-companion/onetone-companion.php') ) {
		$class = 'notice notice-error onetone-install-notice';
		
		if( file_exists( ABSPATH . 'wp-content/plugins/onetone-companion/onetone-companion.php' )  ){
			
			$url = add_query_arg(
					array(
						'action'        => 'activate',
						'plugin'        => rawurlencode( 'onetone-companion/onetone-companion.php' ),
						'plugin_status' => 'all',
						'paged'         => '1',
						'_wpnonce'      => wp_create_nonce( 'activate-plugin_onetone-companion/onetone-companion.php' ),
					), admin_url( 'plugins.php' )
				);
				
			}else{
				
			$url = wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'install-plugin',
							'plugin' => 'onetone-companion',
						),
						esc_url(network_admin_url( 'update.php' ))
					),
					'install-plugin_onetone-companion'
				);
			}
				
		$message = sprintf(__( 'To get full access of customization, you need to install & activate <a class="install-link install-now" data-slug="onetone-companion" href="%s">OneTone Companion</a> plugin.', 'onetone' ),esc_url($url) );
	
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message  ); 
		return;
	}
	
	$plugin_data  = get_plugin_data( WP_PLUGIN_DIR.'/onetone-companion/onetone-companion.php', false, false );
	
	if (version_compare($plugin_data['Version'], '1.0.3' , '>=') ) {
		return;
	}
	
	$url = add_query_arg(
						array(
							'action' => 'upgrade-plugin',
							'plugin' => rawurlencode('onetone-companion/onetone-companion.php'),
							'_wpnonce' => wp_create_nonce( 'upgrade-plugin_onetone-companion/onetone-companion.php' ),
						),
						esc_url(network_admin_url( 'update.php' ))
					);
					
	$class = 'notice notice-error onetone-update-notice';
	$message = sprintf(__( 'To get full access of customization, you need to update <a class="update-link" href="%s">OneTone Companion</a> plugin to the newest version.', 'onetone' ),esc_url($url) );
	
	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message ); 

}
add_action( 'admin_notices', 'onetone_companion_check' );

/**
 * Check front page setup
 */
function onetone_frontpage_check() {
	
	global $onetone_homepage_actived;
	
	if( $onetone_homepage_actived == '0' ){
		$class = 'notice notice-error onetone-create-frontpage';
		$message = sprintf(__( 'To set the front page, you could go to <a href="%1$s">Customize</a> to set it by just one-click. Or you could follow the <a href="%2$s" target="_blank">set-up manual</a> to set it manually.', 'onetone' ), esc_url(admin_url('customize.php' )), esc_url('https://mageewp.com/manuals/theme-guide-onetone.html'));
	
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message ); 
	}

}
add_action( 'admin_notices', 'onetone_frontpage_check' );

/**
 * Framework Config Filter
 */
function onetone_framework_config_filter( $config) {
    $config['url_path'] = get_template_directory_uri().'/lib/kirki/';
    return $config;
}
add_filter( 'options-framework/config', 'onetone_framework_config_filter', 10, 3 );

/**
 * Include the TGM_Plugin_Activation class.
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'onetone_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 */
function onetone_theme_register_required_plugins() {

    $plugins = array(
		array(
			'name'     				=> __('OneTone Companion','onetone'),
			'slug'     				=> 'onetone-companion',
			'source'   				=> esc_url('https://downloads.wordpress.org/plugin/onetone-companion.zip'), 
			'required' 				=> false, 
			'version' 				=> '1.0.3',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
	);

    /**
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'id'           => 'onetone-companion',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',   

    );

    tgmpa( $plugins, $config );

}