<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://nextab.de
 * @since             1.0.0
 * @package           Nxt_Sharing_Buttons
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Social Sharing Buttons
 * Plugin URI:        https://nextab.de
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            nexTab - Oliver Gehrmann
 * Author URI:        https://nextab.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nxt-sharing-buttons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NXT_SHARING_BUTTONS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nxt-sharing-buttons-activator.php
 */
function activate_nxt_sharing_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nxt-sharing-buttons-activator.php';
	Nxt_Sharing_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nxt-sharing-buttons-deactivator.php
 */
function deactivate_nxt_sharing_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nxt-sharing-buttons-deactivator.php';
	Nxt_Sharing_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nxt_sharing_buttons' );
register_deactivation_hook( __FILE__, 'deactivate_nxt_sharing_buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nxt-sharing-buttons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nxt_sharing_buttons() {

	$plugin = new Nxt_Sharing_Buttons();
	$plugin->run();

	function nxt_create_sharing_buttons($atts, $content = null) {
		// Exit plugin if we're not in a single post
		if(!is_single()) return;
		$permalink = urlencode(get_the_permalink());
		$title = get_the_title();
		$encoded_title = urlencode($title);
		$featured_image = urlencode(get_the_post_thumbnail_url());
		$a = shortcode_atts([
			'title'	=> '',
			'class'	=> '',
			'facebook' => 'on',
			'twitter' => 'on',
			'linkedin' => 'on',
			'pinterest' => 'on',
			// 'reddit' => 'on',
			'target' => '_blank',
		], $atts);
		$return_string = '<div class="nxt_sharing_buttons ' . $a["class"] . '">';
		if($a["facebook"] == 'on') {
			$url = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
			$return_string .= '<a href="' . $url . '" target="' . $a["target"] . '" title="' . $title . ' auf Facebook teilen"></a>';
		}
		if($a["twitter"] == 'on') {
			$url = 'https://twitter.com/intent/tweet?text=' . $encoded_title . '&url=' . $permalink;
			$return_string .= '<a href="' . $url . '" target="' . $a["target"] . '" title="' . $title . ' auf Twitter teilen"></a>';
		}
		if($a["linkedin"] == 'on') {
			$url = 'http://www.linkedin.com/shareArticle?mini=true&url=' . $permalink . '&title=' . $encoded_title;
			$return_string .= '<a href="' . $url . '" target="' . $a["target"] . '" title="' . $title . ' auf LinkedIn teilen"></a>';
		}
		if($a["pinterest"] == 'on') {
			$url = 'http://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $featured_image;
			$return_string .= '<a href="' . $url . '" target="' . $a["target"] . '" title="' . $title . ' auf Pinterest teilen"></a>';
		}
		/* if($a["reddit"] == 'on') {
			$url = 'https://reddit.com/submit/?url=' . $permalink . '&amp;resubmit=true&amp;title=' . $title;
			$return_string .= '<a href="' . $url . '" target="' . $a["target"] . '" title="' . $title . ' auf Reddit teilen></a>';
		} */
		$return_string .= '</div> <!-- nxt_sharing_buttons -->';
		return $return_string;
	}
	add_shortcode('ssb', 'nxt_create_sharing_buttons');
}
run_nxt_sharing_buttons();