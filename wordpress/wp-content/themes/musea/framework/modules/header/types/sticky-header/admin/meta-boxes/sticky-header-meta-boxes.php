<?php

if ( ! function_exists( 'musea_elated_sticky_header_meta_boxes_options_map' ) ) {
	function musea_elated_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = musea_elated_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'dependency' => array(
					'hide' => array(
						'eltdf_header_behaviour_meta'  => array( '', 'no-behavior','fixed-on-scroll','sticky-header-on-scroll-up' )
					)
				)
			)
		);

		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_sticky_header_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Sticky Header in Grid', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will put sticky header in grid', 'musea' ),
				'parent'        => $header_meta_box,
				'options'       => musea_elated_get_yes_no_select_array()
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky Header Appearance', 'musea' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'musea' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		$musea_custom_sidebars = musea_elated_get_custom_sidebars();
		if ( count( $musea_custom_sidebars ) > 0 ) {
			musea_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_custom_sticky_menu_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area In Sticky Header Menu Area', 'musea' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header menu area"', 'musea' ),
					'parent'      => $header_meta_box,
					'options'     => $musea_custom_sidebars,
					'dependency' => array(
						'show' => array(
							'eltdf_header_behaviour_meta' => array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' )
						)
					)
				)
			);
		}
	}
	
	add_action( 'musea_elated_action_additional_header_area_meta_boxes_map', 'musea_elated_sticky_header_meta_boxes_options_map', 8 );
}