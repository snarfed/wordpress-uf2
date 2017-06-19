<?php
/*
 Plugin Name: Microformats 2
 Plugin URI: https://github.com/pfefferle/wordpress-uf2
 Description: Adds microformats2 support to your WordPress installation or theme
 Author: pfefferle
 Author URI: http://notizblog.org/
 Version: 1.0.0
 Text Domain: uf2
*/

add_action( 'plugins_loaded', array( 'UF2_Plugin', 'init' ) );

/**
 * Adds microformats2 support to your WordPress theme
 *
 * @author Matthias Pfefferle
 */
class UF2_Plugin {
	/**
	 * Initialize plugin
	 */
	public static function init() {
		// check if theme already supports Microformats2
		if ( current_theme_supports( 'microformats2' ) ) {
			return;
		}
		self::plugin_textdomain();
		require_once dirname( __FILE__ ) . '/includes/author.php';
		$uf2author = new UF2_Author();

		require_once dirname( __FILE__ ) . '/includes/comment.php';
		$uf2comment = new UF2_Comment();

		require_once dirname( __FILE__ ) . '/includes/media.php';
		$uf2media = new UF2_Media();

		require_once dirname( __FILE__ ) . '/includes/post.php';
		$uf2post = new UF2_Post();

		if ( function_exists( 'genesis_html5' ) && genesis_html5() ) {
			require_once dirname( __FILE__ ) . '/includes/genesis.php';
		}
	}

	/**
	 * Load language files
	  */
	public static function plugin_textdomain() {
		// Note to self, the third argument must not be hardcoded, to account for relocated folders.
		load_plugin_textdomain( 'uf2', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

}
