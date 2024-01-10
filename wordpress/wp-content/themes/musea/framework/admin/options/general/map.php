<?php

if ( ! function_exists( 'musea_elated_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function musea_elated_general_options_map() {
		
		musea_elated_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'musea' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = musea_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'enable_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Google Fonts', 'musea' ),
				'parent'        => $panel_design_style
			)
		);
		
		$google_fonts_container = musea_elated_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'google_fonts_container',
				'dependency' => array(
					'hide' => array(
						'enable_google_fonts'  => 'no'
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'musea' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'musea' ),
				'parent'        => $google_fonts_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'musea' ),
				'parent'        => $google_fonts_container
			)
		);
		
		$additional_google_fonts_container = musea_elated_add_admin_container(
			array(
				'parent'          => $google_fonts_container,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'musea' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'musea' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'musea' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'musea' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'musea' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'musea' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'musea' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'musea' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'musea' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'musea' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'musea' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'musea' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'musea' ),
					'100i' => esc_html__( '100 Thin Italic', 'musea' ),
					'200'  => esc_html__( '200 Extra-Light', 'musea' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'musea' ),
					'300'  => esc_html__( '300 Light', 'musea' ),
					'300i' => esc_html__( '300 Light Italic', 'musea' ),
					'400'  => esc_html__( '400 Regular', 'musea' ),
					'400i' => esc_html__( '400 Regular Italic', 'musea' ),
					'500'  => esc_html__( '500 Medium', 'musea' ),
					'500i' => esc_html__( '500 Medium Italic', 'musea' ),
					'600'  => esc_html__( '600 Semi-Bold', 'musea' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'musea' ),
					'700'  => esc_html__( '700 Bold', 'musea' ),
					'700i' => esc_html__( '700 Bold Italic', 'musea' ),
					'800'  => esc_html__( '800 Extra-Bold', 'musea' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'musea' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'musea' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'musea' )
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'musea' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'musea' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'musea' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'musea' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'musea' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'musea' ),
					'greek'        => esc_html__( 'Greek', 'musea' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'musea' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'musea' )
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'musea' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'musea' ),
				'parent'      => $panel_design_style
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'musea' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'musea' ),
				'parent'      => $panel_design_style
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'musea' ),
				'description' => esc_html__( 'Choose the background image for page content', 'musea' ),
				'parent'      => $panel_design_style
			)
		);

        musea_elated_add_admin_field(
            array(
                'name'          => 'page_background_grid',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__( 'Enable page background grid', 'musea' ),
                'description'   => esc_html__( 'Enabling this option will display vertical stripes on all pages', 'musea' ),
                'parent'        => $panel_design_style
            )
        );
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will set the background image as a repeating pattern throughout the page, otherwise the image will appear as the cover background image', 'musea' ),
				'parent'        => $panel_design_style
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'musea' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'musea' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'musea' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = musea_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				musea_elated_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'musea' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'musea' ),
						'parent'      => $boxed_container
					)
				);
				
				musea_elated_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'musea' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'musea' ),
						'parent'      => $boxed_container
					)
				);
				
				musea_elated_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'musea' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'musea' ),
						'parent'      => $boxed_container
					)
				);
				
				musea_elated_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'musea' ),
						'description'   => esc_html__( 'Choose background image attachment', 'musea' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'musea' ),
							'fixed'  => esc_html__( 'Fixed', 'musea' ),
							'scroll' => esc_html__( 'Scroll', 'musea' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'musea' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = musea_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				musea_elated_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'musea' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'musea' ),
						'parent'      => $paspartu_container
					)
				);
				
				musea_elated_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'musea' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'musea' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				musea_elated_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'musea' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'musea' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				musea_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'musea' )
					)
				);
		
				musea_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'musea' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'musea' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'musea' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'musea' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'eltdf-grid-1100' => esc_html__( '1100px - default', 'musea' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'musea' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'musea' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'musea' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'musea' )
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'musea' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'musea' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = musea_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'musea' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'musea' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'musea' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = musea_elated_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				musea_elated_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'musea' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'musea' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = musea_elated_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
				
					musea_elated_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'musea' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = musea_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'musea' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'musea' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = musea_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					musea_elated_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'musea' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
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
					
					musea_elated_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'musea' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					musea_elated_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'musea' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'musea' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'musea' ),
				'parent'        => $panel_settings
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'musea' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = musea_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'musea' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'musea' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = musea_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'musea' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'musea' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'musea_elated_action_options_map', 'musea_elated_general_options_map', musea_elated_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'musea_elated_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function musea_elated_page_general_style( $style ) {
		$current_style = '';
		$page_id       = musea_elated_get_page_id();
		$class_prefix  = musea_elated_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = musea_elated_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = musea_elated_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = musea_elated_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = musea_elated_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.eltdf-boxed .eltdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= musea_elated_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.eltdf-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled .eltdf-sticky-header',
			'.eltdf-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-sticky-header.header-appear',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = musea_elated_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = musea_elated_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( musea_elated_string_ends_with( $paspartu_width, '%' ) || musea_elated_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = musea_elated_string_ends_with( $paspartu_width, '%' ) ? musea_elated_filter_suffix( $paspartu_width, '%' ) : musea_elated_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = musea_elated_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.eltdf-paspartu-enabled .eltdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= musea_elated_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= musea_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= musea_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = musea_elated_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( musea_elated_string_ends_with( $paspartu_responsive_width, '%' ) || musea_elated_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = musea_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? musea_elated_filter_suffix( $paspartu_responsive_width, '%' ) : musea_elated_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = musea_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . musea_elated_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . musea_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . musea_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'musea_elated_filter_add_page_custom_style', 'musea_elated_page_general_style' );
}