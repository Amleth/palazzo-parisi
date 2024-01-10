<?php

if ( ! function_exists( 'musea_elated_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function musea_elated_register_social_icons_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_social_icons_widget' );
}