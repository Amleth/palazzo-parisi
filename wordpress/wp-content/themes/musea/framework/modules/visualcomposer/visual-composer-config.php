<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = MUSEA_ELATED_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'musea_elated_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function musea_elated_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'musea_elated_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'musea_elated_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function musea_elated_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'musea' ),
				'value'      => array(
					esc_html__( 'Full Width', 'musea' ) => 'full-width',
					esc_html__( 'In Grid', 'musea' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Select Anchor ID', 'musea' ),
				'description' => esc_html__( 'For example "home"', 'musea' ),
				'group'       => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'musea' ),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'musea' ),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'musea' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'musea' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'musea' ),
				'value'       => array(
					esc_html__( 'Never', 'musea' )        => '',
					esc_html__( 'Below 1280px', 'musea' ) => '1280',
					esc_html__( 'Below 1024px', 'musea' ) => '1024',
					esc_html__( 'Below 768px', 'musea' )  => '768',
					esc_html__( 'Below 680px', 'musea' )  => '680',
					esc_html__( 'Below 480px', 'musea' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'musea' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Select Parallax Background Image', 'musea' ),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Select Parallax Speed', 'musea' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'musea' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Select Parallax Section Height (px)', 'musea' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'musea' ),
				'value'      => array(
					esc_html__( 'Default', 'musea' ) => '',
					esc_html__( 'Left', 'musea' )    => 'left',
					esc_html__( 'Center', 'musea' )  => 'center',
					esc_html__( 'Right', 'musea' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);

		do_action( 'musea_elated_action_additional_vc_row_params' );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Select Row Content Width', 'musea' ),
				'value'      => array(
					esc_html__( 'Full Width', 'musea' ) => 'full-width',
					esc_html__( 'In Grid', 'musea' )    => 'grid'
				),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Select Background Color', 'musea' ),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Select Background Image', 'musea' ),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Select Background Position', 'musea' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'musea' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Select Disable Background Image', 'musea' ),
				'value'       => array(
					esc_html__( 'Never', 'musea' )        => '',
					esc_html__( 'Below 1280px', 'musea' ) => '1280',
					esc_html__( 'Below 1024px', 'musea' ) => '1024',
					esc_html__( 'Below 768px', 'musea' )  => '768',
					esc_html__( 'Below 680px', 'musea' )  => '680',
					esc_html__( 'Below 480px', 'musea' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'musea' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Select Content Aligment', 'musea' ),
				'value'      => array(
					esc_html__( 'Default', 'musea' ) => '',
					esc_html__( 'Left', 'musea' )    => 'left',
					esc_html__( 'Center', 'musea' )  => 'center',
					esc_html__( 'Right', 'musea' )   => 'right'
				),
				'group'      => esc_html__( 'Select Settings', 'musea' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( musea_elated_is_plugin_installed( 'revolution-slider' ) ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Select Enable Passepartout', 'musea' ),
					'value'       => array_flip( musea_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Select Settings', 'musea' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Select Passepartout Size', 'musea' ),
					'value'       => array(
						esc_html__( 'Tiny', 'musea' )   => 'tiny',
						esc_html__( 'Small', 'musea' )  => 'small',
						esc_html__( 'Normal', 'musea' ) => 'normal',
						esc_html__( 'Large', 'musea' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'musea' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Select Disable Side Passepartout', 'musea' ),
					'value'       => array_flip( musea_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'musea' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Select Disable Top Passepartout', 'musea' ),
					'value'       => array_flip( musea_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Select Settings', 'musea' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'musea_elated_vc_row_map' );
}