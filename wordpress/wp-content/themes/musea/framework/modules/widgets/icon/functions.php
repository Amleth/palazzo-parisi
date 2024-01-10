<?php

if ( ! function_exists( 'musea_elated_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function musea_elated_register_icon_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_icon_widget' );
}