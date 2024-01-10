<?php

if ( ! function_exists( 'musea_elated_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function musea_elated_register_social_icon_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_social_icon_widget' );
}