<?php

if ( ! function_exists( 'musea_elated_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function musea_elated_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_sticky_sidebar_widget' );
}