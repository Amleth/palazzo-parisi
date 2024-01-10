<?php

if ( ! function_exists( 'musea_elated_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function musea_elated_register_search_opener_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_search_opener_widget' );
}