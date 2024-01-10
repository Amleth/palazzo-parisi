<?php

if ( ! function_exists( 'musea_elated_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function musea_elated_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_sidearea_opener_widget' );
}