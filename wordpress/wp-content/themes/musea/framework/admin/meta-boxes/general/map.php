<?php

if ( ! function_exists( 'musea_elated_map_general_meta' ) ) {
	function musea_elated_map_general_meta() {
		
		$general_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'musea_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'musea' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'musea' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'musea' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'musea' ),
				'parent'        => $general_meta_box
			)
		);
		
		$eltdf_content_padding_group = musea_elated_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'musea' ),
				'description' => esc_html__( 'Define styles for Content area', 'musea' ),
				'parent'      => $general_meta_box
			)
		);
		
			$eltdf_content_padding_row = musea_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row',
					'parent' => $eltdf_content_padding_group
				)
			);
			
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'musea' ),
						'parent'      => $eltdf_content_padding_row
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'musea' ),
						'parent'        => $eltdf_content_padding_row
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'musea' ),
						'options'       => musea_elated_get_yes_no_select_array(),
						'parent'        => $eltdf_content_padding_row
					)
				);
		
			$eltdf_content_padding_row_1 = musea_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row_1',
					'next'   => true,
					'parent' => $eltdf_content_padding_group
				)
			);
		
				musea_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'musea' ),
						'parent' => $eltdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'    => 'eltdf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'musea' ),
						'parent'  => $eltdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'musea' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'musea' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'musea' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'musea' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'musea' ),
					'eltdf-grid-1100' => esc_html__( '1100px', 'musea' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'musea' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'musea' )
				)
			)
		);

        musea_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_page_background_grid_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Enable page background grid', 'musea' ),
                'description'   => esc_html__( 'Enabling this option will display vertical stripes on the page', 'musea' ),
                'parent'        => $general_meta_box,
                'options'       => array(
                    ''                => esc_html__( 'Default', 'musea' ),
                    'yes' => esc_html__( 'Yes', 'musea' ),
                    'no' => esc_html__( 'No', 'musea' )
                )
            )
        );
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'musea' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'musea' ),
				'options'     => musea_elated_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		musea_elated_create_meta_box_field(
			array(
				'name'    => 'eltdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'musea' ),
				'parent'  => $general_meta_box,
				'options' => musea_elated_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = musea_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'musea' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'musea' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'musea' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'musea' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'musea' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'musea' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'musea' ),
						'description'   => esc_html__( 'Choose background image attachment', 'musea' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'musea' ),
							'fixed'  => esc_html__( 'Fixed', 'musea' ),
							'scroll' => esc_html__( 'Scroll', 'musea' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'musea' ),
				'parent'        => $general_meta_box,
				'options'       => musea_elated_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = musea_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'eltdf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'musea' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'musea' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'musea' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'musea' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'musea' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'musea' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);

                musea_elated_create_meta_box_field(
                    array(
                        'parent'      => $paspartu_container_meta,
                        'type'        => 'image',
                        'name'        => 'eltdf_paspartu_image',
                        'label'       => esc_html__( 'Passepartout Background Image', 'musea' ),
                        'description' => esc_html__( 'Choose an image for page passepartout', 'musea' )
                    )
                );
				
				musea_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'musea' ),
						'options'       => musea_elated_get_yes_no_select_array(),
					)
				);
		
				musea_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'musea' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'musea' ),
						'options'       => musea_elated_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'musea' ),
				'parent'        => $general_meta_box,
				'options'       => musea_elated_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = musea_elated_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				musea_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'musea' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'musea' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => musea_elated_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = musea_elated_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'eltdf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					musea_elated_create_meta_box_field(
						array(
							'name'   => 'eltdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'musea' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = musea_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'musea' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'musea' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = musea_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					musea_elated_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'eltdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'musea' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'musea' ),
								'musea_spinner'         => esc_html__( 'Musea Spinner', 'musea' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'musea' ),
								'pulse'                 => esc_html__( 'Pulse', 'musea' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'musea' ),
								'cube'                  => esc_html__( 'Cube', 'musea' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'musea' ),
								'stripes'               => esc_html__( 'Stripes', 'musea' ),
								'wave'                  => esc_html__( 'Wave', 'musea' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'musea' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'musea' ),
								'atom'                  => esc_html__( 'Atom', 'musea' ),
								'clock'                 => esc_html__( 'Clock', 'musea' ),
								'mitosis'               => esc_html__( 'Mitosis', 'musea' ),
								'lines'                 => esc_html__( 'Lines', 'musea' ),
								'fussion'               => esc_html__( 'Fussion', 'musea' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'musea' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'musea' )
							)
						)
					);
					
					musea_elated_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'eltdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'musea' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);

					musea_elated_add_multiple_images_field(
						array(
							'name'        => 'eltdf_gallery_spinner_images_meta',
							'label'       => esc_html__( 'Preloader Images', 'musea' ),
							'description' => esc_html__( 'Choose your preloader images. Please not that these images will be shown only when "Musea Spinner" is set as Spinner Type', 'musea' ),
							'parent'      => $row_pt_spinner_animation_meta,
							'dependency' => array(
								'show' => array(
									'eltdf_smooth_pt_spinner_type_meta' => 'musea_spinner'
								)
							)
						)
					);
					
					musea_elated_create_meta_box_field(
						array(
							'name'        => 'eltdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'musea' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'musea' ),
							'options'     => musea_elated_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'musea' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'musea' ),
				'parent'      => $general_meta_box,
				'options'     => musea_elated_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_general_meta', 10 );
}

if ( ! function_exists( 'musea_elated_container_background_style' ) ) {
    /**
     * Function that return container style
     *
     * @param $style
     *
     * @return string
     */
    function musea_elated_container_background_style( $style ) {
        $page_id      = musea_elated_get_page_id();
        $class_prefix = musea_elated_get_unique_page_class( $page_id, true );

        $container_selector = array(
            $class_prefix . ' .eltdf-content'
        );

        $container_class        = array();
        $current_style = '';
        $page_background_color  = get_post_meta( $page_id, 'eltdf_page_background_color_meta', true );
        $page_background_image  = get_post_meta( $page_id, 'eltdf_page_background_image_meta', true );
        $page_background_repeat = get_post_meta( $page_id, 'eltdf_page_background_repeat_meta', true );

        if ( ! empty( $page_background_color ) ) {
            $container_class['background-color'] = $page_background_color;
        }

        if ( ! empty( $page_background_image ) ) {
            $container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';

            if ( $page_background_repeat === 'yes' ) {
                $container_class['background-repeat']   = 'repeat';
                $container_class['background-position'] = '0 0';
            } else {
                $container_class['background-repeat']   = 'no-repeat';
                $container_class['background-position'] = 'center 0';
                $container_class['background-size']     = 'cover';
            }
        }


        if(! empty( $container_class )) {
            $current_style = musea_elated_dynamic_css( $container_selector, $container_class );
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter( 'musea_elated_filter_add_page_custom_style', 'musea_elated_container_background_style' );
}

if ( ! function_exists( 'musea_elated_container_passepartout_style' ) ) {
    /**
     * Function that return container style
     *
     * @param $style
     *
     * @return string
     */
    function musea_elated_container_passepartout_style( $style ) {

        $class_prefix = '';

        $container_selector = array(
            $class_prefix . ' .eltdf-wrapper'
        );

        $container_class        = array();
        $current_style = '';
        $page_passepartout_image =  get_post_meta( get_the_ID(), 'eltdf_paspartu_image', true );


        if ( ! empty( $page_passepartout_image ) ) {
            $container_class['background-image'] = 'url(' . esc_url( $page_passepartout_image ) . ')';
            $container_class['background-repeat']   = 'repeat-y';
            $container_class['background-position'] = 'center 0';
        }


        if(! empty( $container_class )) {
            $current_style = musea_elated_dynamic_css( $container_selector, $container_class );
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter( 'musea_elated_filter_add_page_custom_style', 'musea_elated_container_passepartout_style' );
}