<?php

if ( ! function_exists( 'musea_elated_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function musea_elated_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_image_gallery_widget' );
}