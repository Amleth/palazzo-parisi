<?php

if ( ! function_exists( 'musea_elated_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function musea_elated_register_blog_list_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_blog_list_widget' );
}