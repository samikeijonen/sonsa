<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Sonsa
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://foxland.fi',     // Site where EDD is hosted
		'item_name'      => 'Sonsa',                  // Name of theme
		'theme_slug'     => 'sonsa',                  // Theme slug
		'version'        => SONSA_VERSION,            // The current version of this theme
		'author'         => 'Sami Keijonen',          // The author of this theme
		'download_id'    => '4587',                   // Optional, used for generating a license renewal link
		'renew_url'      => ''                        // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'sonsa' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'sonsa' ),
		'license-key'               => __( 'License Key', 'sonsa' ),
		'license-action'            => __( 'License Action', 'sonsa' ),
		'deactivate-license'        => __( 'Deactivate License', 'sonsa' ),
		'activate-license'          => __( 'Activate License', 'sonsa' ),
		'status-unknown'            => __( 'License status is unknown.', 'sonsa' ),
		'renew'                     => __( 'Renew?', 'sonsa' ),
		'unlimited'                 => __( 'unlimited', 'sonsa' ),
		'license-key-is-active'     => __( 'License key is active.', 'sonsa' ),
		'expires%s'                 => __( 'Expires %s.', 'sonsa' ),
		'lifetime'                  => __( 'Lifetime License.', 'sonsa' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'sonsa' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'sonsa' ),
		'license-key-expired'       => __( 'License key has expired.', 'sonsa' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'sonsa' ),
		'license-is-inactive'       => __( 'License is inactive.', 'sonsa' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'sonsa' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'sonsa' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'sonsa' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'sonsa' ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'sonsa' )
	)

);