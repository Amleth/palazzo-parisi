<?php

if ( ! function_exists( 'musea_elated_mobile_menu_meta_box_map' ) ) {
	function musea_elated_mobile_menu_meta_box_map($header_meta_box) {

		musea_elated_add_admin_section_title(
			array(
				'parent' => $header_meta_box,
				'name'   => 'header_mobile',
				'title'  => esc_html__( 'Mobile Header in Grid', 'musea' )
			)
		);

		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_mobile_header_in_grid_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Mobile Header in Grid', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will put mobile header in grid', 'musea' ),
				'parent'        => $header_meta_box,
				'options'       => musea_elated_get_yes_no_select_array()
			)
		);

		$mobile_header_without_grid_container = musea_elated_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'mobile_header_without_grid_container',
				'dependency' => array(
					'show' => array(
						'eltdf_mobile_header_in_grid_meta' => 'no'
					)
				)
			)
		);

		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_mobile_header_without_grid_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Header Padding', 'musea' ),
				'description' => esc_html__( 'Set padding for Mobile Header', 'musea' ),
				'parent'      => $mobile_header_without_grid_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);


	}
	
	add_action( 'musea_elated_action_header_mobile_menu_meta_boxes_map', 'musea_elated_mobile_menu_meta_box_map', 10 );
}