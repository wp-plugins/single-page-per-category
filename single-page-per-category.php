<?php
/*
 * Plugin Name: Single Page Per Category
 * Version: 1.0.1
 * Plugin URI: http://tybulewicz.com/
 * Description: This plugin enables themes to use custom single.php pages for categories.
 * Author: Tomasz Tybulewicz
 * Author URI: http://tybulewicz.com/
 * Requires at least: 3.8
 * Tested up to: 4.2.2
 *
 * @package WordPress
 * @author Tomasz Tybulewicz <tomasz@tybulewicz.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Include plugin class files
require_once( 'includes/class-single-page-per-category.php' );

/**
 * Returns the main instance of Single_Page_Per_Category to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Single_Page_Per_Category
 */
function Single_Page_Per_Category () {
	$instance = Single_Page_Per_Category::instance( __FILE__, '1.0.0' );
	add_filter('single_template', array($instance, 'get_single_per_category_template'));

	return $instance;
}

Single_Page_Per_Category();
