<?php

if ( ! function_exists( 'musea_elated_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function musea_elated_register_separator_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_separator_widget' );
}