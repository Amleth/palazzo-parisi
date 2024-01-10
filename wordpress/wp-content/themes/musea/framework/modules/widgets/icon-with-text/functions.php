<?php

if ( ! function_exists( 'musea_elated_register_icon_with_text_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function musea_elated_register_icon_with_text_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassIconWithTextWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_icon_with_text_widget' );
}