<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           funnyform
 *
 * @wordpress-plugin
 * Plugin Name:       Funny Form
 * Description:       Funny Form. Contact.
 * Version:           1.0.0
 * Author:            Andrew Levin
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       funnyform
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 *  Form, shortcode and main handler
 **/
require_once 'shortcode-funnyform.php';


/**
 *  Post type registration and admin view
 **/
require_once 'posttype-funnyform.php';






