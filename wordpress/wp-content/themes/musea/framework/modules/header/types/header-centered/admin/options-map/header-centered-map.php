<?php

if ( ! function_exists( 'musea_elated_get_hide_dep_for_header_centered_options' ) ) {
	function musea_elated_get_hide_dep_for_header_centered_options() {
		$hide_dep_options = apply_filters( 'musea_elated_filter_header_centered_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'musea_elated_header_centered_map' ) ) {
	function musea_elated_header_centered_map( $parent ) {
		$hide_dep_options = musea_elated_get_hide_dep_for_header_centered_options();
		
		musea_elated_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'logo_wrapper_padding_header_centered',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'musea' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'musea' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'musea_elated_header_logo_area_additional_options', 'musea_elated_header_centered_map' );
}