<?php

if ( ! function_exists( 'musea_elated_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function musea_elated_search_body_class( $classes ) {
		$classes[] = 'eltdf-search-covers-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_search_body_class' );
}

if ( ! function_exists( 'musea_elated_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function musea_elated_get_search() {
		musea_elated_load_search_template();
	}
	
	add_action( 'musea_elated_action_before_page_header_html_close', 'musea_elated_get_search' );
	add_action( 'musea_elated_action_before_mobile_header_html_close', 'musea_elated_get_search' );
}

if ( ! function_exists( 'musea_elated_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function musea_elated_load_search_template() {

		$search_in_grid   = musea_elated_options()->getOptionValue( 'search_in_grid' ) == 'yes';
		
		$parameters = array(
			'search_in_grid'    		=> $search_in_grid,
			'search_close_icon_class' 	=> musea_elated_get_search_close_icon_class()
		);
		
		musea_elated_get_module_template_part( 'types/covers-header/templates/covers-header', 'search', '', $parameters );
	}
}