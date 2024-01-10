<?php
if ( ! function_exists( 'musea_shows_add_role_slider_shortcode' ) ) {
	function musea_shows_add_role_slider_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'MuseaShows\CPT\Shortcodes\Roles\RoleSlider'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'musea_shows_filter_add_vc_shortcode', 'musea_shows_add_role_slider_shortcode' );
}

if ( ! function_exists( 'musea_shows_set_role_slider_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for role slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function musea_shows_set_role_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-role-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'musea_shows_filter_add_vc_shortcodes_custom_icon_class', 'musea_shows_set_role_slider_icon_class_name_for_vc_shortcodes' );
}