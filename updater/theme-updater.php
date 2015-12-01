<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	//$my_theme = wp_get_theme();
	$config = array(
		'remote_api_url' => 'https://premiumcoding.com/', // Site where EDD is hosted
		'item_name' => 'Studio', // Name of theme
		'theme_slug' => 'studio', // Theme slug
		'version' => wp_get_theme()->get( 'Version' ), // The current version of this theme
		'author' => 'PremiumCoding', // The author of this theme
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'pmc-themes' ),
		'enter-key' => __( 'Enter your theme license key.', 'pmc-themes' ),
		'license-key' => __( 'License Key', 'pmc-themes' ),
		'license-action' => __( 'License Action', 'pmc-themes' ),
		'deactivate-license' => __( 'Deactivate License', 'pmc-themes' ),
		'activate-license' => __( 'Activate License', 'pmc-themes' ),
		'status-unknown' => __( 'License status is unknown.', 'pmc-themes' ),
		'renew' => __( 'Renew?', 'pmc-themes' ),
		'unlimited' => __( 'unlimited', 'pmc-themes' ),
		'license-key-is-active' => __( 'License key is active.', 'pmc-themes' ),
		'expires%s' => __( 'Expires %s.', 'pmc-themes' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'pmc-themes' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'pmc-themes' ),
		'license-key-expired' => __( 'License key has expired.', 'pmc-themes' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'pmc-themes' ),
		'license-is-inactive' => __( 'License is inactive.', 'pmc-themes' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'pmc-themes' ),
		'site-is-inactive' => __( 'Site is inactive.', 'pmc-themes' ),
		'license-status-unknown' => __( 'License status is unknown.', 'pmc-themes' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'pmc-themes' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'pmc-themes' )
	)

);