<?php

if ( ! function_exists( 'musea_elated_get_hide_dep_for_dropdown_meta_boxes' ) ) {
	function musea_elated_get_hide_dep_for_dropdown_meta_boxes() {
		$hide_dep_options = apply_filters( 'musea_elated_filter_dropdown_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'musea_elated_dropdown_meta_options_map' ) ) {
	function musea_elated_dropdown_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= musea_elated_get_hide_dep_for_dropdown_meta_boxes();

		$dropdown_container = musea_elated_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'dropdown_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta' => $hide_dep_widgets
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		musea_elated_add_admin_section_title(
			array(
				'parent' => $dropdown_container,
				'name'   => 'dropdown_styles',
				'title'  => esc_html__( 'Dropdown Styles', 'musea' )
			)
		);


		musea_elated_create_meta_box_field(
			array(
				'parent'        => $dropdown_container,
				'type'          => 'text',
				'name'          => 'eltdf_dropdown_top_position_meta',
				'label'         => esc_html__( 'Dropdown Position', 'musea' ),
				'description'   => esc_html__( 'Enter value in percentage of entire header height', 'musea' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => '%'
				)
			)
		);

        musea_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_wide_dropdown_menu_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Wide Dropdown Menu In Grid', 'musea' ),
                'description'   => esc_html__( 'Set wide dropdown menu to be in grid', 'musea' ),
                'parent'        => $dropdown_container,
                'default_value' => '',
                'options'       => musea_elated_get_yes_no_select_array()
            )
        );

        $wide_dropdown_menu_in_grid_container = musea_elated_add_admin_container(
            array(
                'type'            => 'container',
                'name'            => 'wide_dropdown_menu_in_grid_container',
                'parent'          => $dropdown_container,
                'dependency' => array(
                    'show' => array(
                        'eltdf_wide_dropdown_menu_in_grid_meta'  => 'no'
                    )
                )
            )
        );

        musea_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_wide_dropdown_menu_content_in_grid_meta',
                'type'          => 'select',
                'label'       => esc_html__( 'Wide Dropdown Menu Content In Grid', 'musea' ),
                'description' => esc_html__( 'Set wide dropdown menu content to be in grid', 'musea' ),
                'parent'      => $wide_dropdown_menu_in_grid_container,
                'default_value' => '',
                'options'       => musea_elated_get_yes_no_select_array()
            )
        );
			
	
		
		do_action( 'musea_elated_dropdown_additional_meta_boxes_map', $dropdown_container );
	}
	
	add_action( 'musea_elated_action_dropdown_meta_boxes_map', 'musea_elated_dropdown_meta_options_map', 10, 1 );
}