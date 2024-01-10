<?php

if ( ! function_exists( 'musea_elated_portfolio_options_map' ) ) {
	function musea_elated_portfolio_options_map() {
		
		musea_elated_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'musea-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'musea-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'musea-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'musea-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'musea-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'musea-core' ),
				'parent'        => $panel_archive,
				'options'       => musea_elated_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'musea-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'musea-core' ),
				'default_value' => 'normal',
				'options'       => musea_elated_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'musea-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'musea-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'musea-core' ),
					'landscape' => esc_html__( 'Landscape', 'musea-core' ),
					'portrait'  => esc_html__( 'Portrait', 'musea-core' ),
					'square'    => esc_html__( 'Square', 'musea-core' )
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'musea-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'musea-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'musea-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'musea-core' )
				)
			)
		);
		
		$panel = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'musea-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'musea-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'musea-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = musea_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'musea-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'musea-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => musea_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'musea-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'musea-core' ),
				'default_value' => 'normal',
				'options'       => musea_elated_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = musea_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'musea-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'musea-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => musea_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'musea-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'musea-core' ),
				'default_value' => 'normal',
				'options'       => musea_elated_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		musea_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'musea-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'musea-core' ),
					'yes' => esc_html__( 'Yes', 'musea-core' ),
					'no'  => esc_html__( 'No', 'musea-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'musea-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'musea-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'musea-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'musea-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'musea-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'musea-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'musea-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = musea_elated_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'musea-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'musea-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'musea-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'musea-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_options_map', 'musea_elated_portfolio_options_map', musea_elated_set_options_map_position( 'portfolio' ) );
}