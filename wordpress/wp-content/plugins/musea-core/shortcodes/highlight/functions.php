<?php

if ( ! function_exists( 'musea_core_add_highlight_shortcodes' ) ) {
	function musea_core_add_highlight_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MuseaCore\CPT\Shortcodes\Highlight\Highlight'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'musea_core_filter_add_vc_shortcode', 'musea_core_add_highlight_shortcodes' );
}