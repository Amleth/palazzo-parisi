<?php

if ( ! function_exists( 'musea_elated_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function musea_elated_register_button_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_button_widget' );
}