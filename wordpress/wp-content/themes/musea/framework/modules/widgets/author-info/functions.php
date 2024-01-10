<?php

if ( ! function_exists( 'musea_elated_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function musea_elated_register_author_info_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_author_info_widget' );
}