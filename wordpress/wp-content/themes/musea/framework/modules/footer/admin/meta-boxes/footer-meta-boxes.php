<?php

if ( ! function_exists( 'musea_elated_map_footer_meta' ) ) {
	function musea_elated_map_footer_meta() {
		
		$footer_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'musea_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'musea' ),
				'name'  => 'footer_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer For This Page', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'musea' ),
				'options'       => musea_elated_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = musea_elated_add_admin_container(
			array(
				'name'       => 'eltdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			musea_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'musea' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'musea' ),
					'options'       => musea_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			musea_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'musea' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'musea' ),
					'options'       => musea_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			musea_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'musea' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'musea' ),
					'options'       => musea_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_top_styles_group = musea_elated_add_admin_group(
				array(
					'name'        => 'footer_top_styles_group',
					'title'       => esc_html__( 'Footer Top Styles', 'musea' ),
					'description' => esc_html__( 'Define style for footer top area', 'musea' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'eltdf_show_footer_top_meta' => 'no'
						)
					)
				)
			);
			
			$footer_top_styles_row_1 = musea_elated_add_admin_row(
				array(
					'name'   => 'footer_top_styles_row_1',
					'parent' => $footer_top_styles_group
				)
			);
		
				musea_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_top_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'musea' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_top_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'musea' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_top_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'musea' ),
						'parent' => $footer_top_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
			
			musea_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'musea' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'musea' ),
					'options'       => musea_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_bottom_styles_group = musea_elated_add_admin_group(
				array(
					'name'        => 'footer_bottom_styles_group',
					'title'       => esc_html__( 'Footer Bottom Styles', 'musea' ),
					'description' => esc_html__( 'Define style for footer bottom area', 'musea' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'eltdf_show_footer_bottom_meta' => 'no'
						)
					)
				)
			);
			
			$footer_bottom_styles_row_1 = musea_elated_add_admin_row(
				array(
					'name'   => 'footer_bottom_styles_row_1',
					'parent' => $footer_bottom_styles_group
				)
			);
			
				musea_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_bottom_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'musea' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_bottom_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'musea' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_bottom_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'musea' ),
						'parent' => $footer_bottom_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_footer_meta', 70 );
}