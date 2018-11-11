<?php
/*
Plugin name: MooTools Backup
Plugin URI: https://takahashifumiki.com/mootools
Description: Backup for MooTools documentation backup.
Author: Takahashi Fumiki
Author URI: https://takahashifumiki.com
Version: 1.0.0
*/

defined( 'ABSPATH' ) || die();



/**
 * If MooTools Category, change templates.
 */
add_filter( 'template_include', function( $template ){
	if ( ! is_mootools() ) {
		return $template;
	}
	if ( is_single() ) {
		if ( 294 === get_queried_object_id() ) {
			return __DIR__ . '/download.php';
		} else {
			return __DIR__ . '/moo.php';
		}
	} else {
		return __DIR__ . '/moo-front.php';
	}
}, 9999 );

/**
 * Detect if current page belongs to MooTools.
 *
 * @return bool
 */
function is_mootools() {
	if ( is_single() ) {
		$categories = get_the_category( get_queried_object_id() );
		if ( $categories && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				if ( 'mootools' === $category->slug ) {
					return true;
				}
			}
		}
		return false;
	} elseif ( is_category() ) {
		return 'mootools' === get_queried_object()->slug;
	} else {
		return false;
	}
}

/**
 * MooTools URL
 *
 * @return string
 */
function mootools_url() {
	return rtrim( plugin_dir_url( __FILE__ ) );
}
