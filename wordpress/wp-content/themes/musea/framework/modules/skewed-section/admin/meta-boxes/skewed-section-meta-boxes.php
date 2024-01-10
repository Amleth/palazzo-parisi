<?php

if ( ! function_exists( 'musea_elated_skewed_section_title_meta' ) ) {
	function musea_elated_skewed_section_title_meta( $show_title_area_container ) {
		
		musea_elated_add_admin_section_title(
			array(
				'parent' => $show_title_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'musea' )
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_enable_skewed_section_on_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'musea' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Title Area', 'musea' ),
				'options'       => musea_elated_get_yes_no_select_array(),
				'parent'        => $show_title_area_container
			)
		);
		
		$show_skewed_section_title_area_container = musea_elated_add_admin_container(
			array(
				'parent'     => $show_title_area_container,
				'name'       => 'show_skewed_section_title_area_container',
				'dependency' => array(
					'show' => array(
						'eltdf_enable_skewed_section_on_title_area_meta' => 'yes'
					)
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_title_area_skewed_section_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Position', 'musea' ),
				'description'   => esc_html__( 'Specify skewed section position', 'musea' ),
				'parent'        => $show_skewed_section_title_area_container,
				'options'       => array(
					''        => esc_html__( 'Default', 'musea' ),
					'outline' => esc_html__( 'Outline', 'musea' ),
					'inset'   => esc_html__( 'Inset', 'musea' )
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'textarea',
				'name'        => 'eltdf_title_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Title Area SVG Path', 'musea' ),
				'description' => esc_html__( 'Enter your Section On Title Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'musea' ),
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'color',
				'name'        => 'eltdf_title_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'musea' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'musea' ),
			)
		);
	}
	
	add_action( 'musea_elated_action_additional_title_area_meta_boxes', 'musea_elated_skewed_section_title_meta', 20 );
}

if ( ! function_exists( 'musea_elated_skewed_section_header_meta' ) ) {
	function musea_elated_skewed_section_header_meta( $show_header_area_container ) {
		
		musea_elated_add_admin_section_title(
			array(
				'parent' => $show_header_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'musea' )
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_enable_skewed_section_on_header_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'musea' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Header Area', 'musea' ),
				'options'       => musea_elated_get_yes_no_select_array(),
				'parent'        => $show_header_area_container
			)
		);
		
		$show_skewed_section_header_area_container = musea_elated_add_admin_container(
			array(
				'parent'     => $show_header_area_container,
				'name'       => 'show_skewed_section_header_area_container',
				'dependency' => array(
					'show' => array(
						'eltdf_enable_skewed_section_on_header_area_meta' => 'yes'
					)
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'textarea',
				'name'        => 'eltdf_header_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Header Area SVG Path', 'musea' ),
				'description' => esc_html__( 'Enter your Section On Header Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'musea' ),
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'color',
				'name'        => 'eltdf_header_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'musea' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'musea' ),
			)
		);
	}
	
	add_action( 'musea_elated_action_additional_header_area_meta_boxes', 'musea_elated_skewed_section_header_meta', 20 );
}