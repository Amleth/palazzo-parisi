<?php

if ( ! function_exists( 'musea_elated_get_title_types_meta_boxes' ) ) {
	function musea_elated_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'musea_elated_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'musea' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( MUSEA_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'musea_elated_map_title_meta' ) ) {
	function musea_elated_map_title_meta() {
		$title_type_meta_boxes = musea_elated_get_title_types_meta_boxes();
		
		$title_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'musea_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'musea' ),
				'name'  => 'title_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'musea' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'musea' ),
				'parent'        => $title_meta_box,
				'options'       => musea_elated_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = musea_elated_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'eltdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'eltdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'musea' ),
						'description'   => esc_html__( 'Choose title type', 'musea' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'musea' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'musea' ),
						'options'       => musea_elated_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'musea' ),
						'description' => esc_html__( 'Set a height for Title Area', 'musea' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);

				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_height_mobile_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height on Mobile', 'musea' ),
						'description' => esc_html__( 'Set a height for Title Area on Mobile', 'musea' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'musea' ),
						'description' => esc_html__( 'Choose a background color for title area', 'musea' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'musea' ),
						'description' => esc_html__( 'Choose an Image for title area', 'musea' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'musea' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'musea' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'musea' ),
							'hide'                => esc_html__( 'Hide Image', 'musea' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'musea' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'musea' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'musea' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'musea' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'musea' )
						)
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'musea' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'musea' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'musea' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'musea' ),
							'window-top'    => esc_html__( 'From Window Top', 'musea' )
						)
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'musea' ),
						'options'       => musea_elated_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'musea' ),
						'description' => esc_html__( 'Choose a color for title text', 'musea' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'musea' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'musea' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'musea' ),
						'options'       => musea_elated_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'musea' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'musea' ),
						'parent'      => $show_title_area_meta_container
					)
				);

                musea_elated_create_meta_box_field(
                    array(
                        'name'          => 'eltdf_title_area_caption_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Caption Text', 'musea' ),
                        'description'   => esc_html__( 'Enter your caption text (Works only with Full Photo Background template)', 'musea' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'          => array(
                            'col_width' => 6
                        )
                    )
                );

                musea_elated_create_meta_box_field(
                    array(
                        'name'        => 'eltdf_caption_color_meta',
                        'type'        => 'color',
                        'label'       => esc_html__( 'Caption Color', 'musea' ),
                        'description' => esc_html__( 'Choose a color for caption text', 'musea' ),
                        'parent'      => $show_title_area_meta_container
                    )
                );

		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'musea_elated_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_title_meta', 60 );
}