<?php

if ( ! function_exists( 'musea_elated_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function musea_elated_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'musea' );
		
		return $type;
	}
	
	add_filter( 'musea_elated_filter_title_type_global_option', 'musea_elated_set_title_centered_type_for_options' );
	add_filter( 'musea_elated_filter_title_type_meta_boxes', 'musea_elated_set_title_centered_type_for_options' );
}