<?php

if ( ! function_exists( 'musea_elated_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function musea_elated_register_custom_font_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_custom_font_widget' );
}