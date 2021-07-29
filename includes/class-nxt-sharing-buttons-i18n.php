<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://nextab.de
 * @since      1.0.0
 *
 * @package    Nxt_Sharing_Buttons
 * @subpackage Nxt_Sharing_Buttons/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Nxt_Sharing_Buttons
 * @subpackage Nxt_Sharing_Buttons/includes
 * @author     nexTab - Oliver Gehrmann <info@nextab.de>
 */
class Nxt_Sharing_Buttons_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nxt-sharing-buttons',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
