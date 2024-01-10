<?php

if ( ! function_exists( 'musea_elated_include_blog_shortcodes' ) ) {
	function musea_elated_include_blog_shortcodes() {
		foreach ( glob( MUSEA_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( musea_elated_is_plugin_installed( 'core' ) ) {
		add_action( 'musea_core_action_include_shortcodes_file', 'musea_elated_include_blog_shortcodes' );
	}
}
