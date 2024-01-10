<?php

if ( ! function_exists( 'musea_core_map_portfolio_settings_meta' ) ) {
	function musea_core_map_portfolio_settings_meta() {
		$meta_box = musea_elated_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'musea-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		musea_elated_create_meta_box_field( array(
			'name'        => 'eltdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'musea-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'musea-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'musea-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'musea-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'musea-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'musea-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'musea-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'musea-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'musea-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'musea-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'musea-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'musea-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'musea-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'musea-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = musea_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'musea-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'musea-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => musea_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'musea-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'musea-core' ),
				'default_value' => '',
				'options'       => musea_elated_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = musea_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'musea-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'musea-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => musea_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'musea-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'musea-core' ),
				'default_value' => '',
				'options'       => musea_elated_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'musea-core' ),
				'parent'        => $meta_box,
				'options'       => musea_elated_get_yes_no_select_array()
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'musea-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'musea-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'musea-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'musea-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'musea-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'musea-core' ),
				'parent'      => $meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'musea-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'musea-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'musea-core' ),
					'small'              => esc_html__( 'Small', 'musea-core' ),
					'large-width'        => esc_html__( 'Large Width', 'musea-core' ),
					'large-height'       => esc_html__( 'Large Height', 'musea-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'musea-core' )
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'musea-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'musea-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'musea-core' ),
					'large-width' => esc_html__( 'Large Width', 'musea-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'musea-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'musea-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_core_map_portfolio_settings_meta', 41 );
}