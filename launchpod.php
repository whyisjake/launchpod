<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jakespurlock.com
 * @since             1.0.0
 * @package           Launchpod
 *
 * @wordpress-plugin
 * Plugin Name:       LaunchPod
 * Plugin URI:        https://github.com/whyisjake/launchpod
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jake Spurlock
 * Author URI:        https://jakespurlock.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       launchpod
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Include the post-type files.
include plugin_dir_path( __FILE__ ) . 'post-types/submissions.php';
include plugin_dir_path( __FILE__ ) . 'post-types/votes.php';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LAUNCHPOD_VERSION', '1.0.0' );

add_action( 'pre_get_posts', 'add_submissions_post_type_to_home' );

function add_submissions_post_type_to_home( $query ) {
	if ( $query->is_main_query() && $query->is_home() ) {
		$query->set( 'post_type', array( 'post', 'submissions' ) );
	}
}

