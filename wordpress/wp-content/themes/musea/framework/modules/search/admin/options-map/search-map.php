<?php

if ( ! function_exists( 'musea_elated_get_search_types_options' ) ) {
    function musea_elated_get_search_types_options() {
        $search_type_options = apply_filters( 'musea_elated_filter_search_type_global_option', $search_type_options = array() );

        return $search_type_options;
    }
}

if ( ! function_exists( 'musea_elated_search_options_map' ) ) {
	function musea_elated_search_options_map() {
		
		musea_elated_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'musea' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'musea' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'search_page_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Layout', 'musea' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set layout. Default is in grid.', 'musea' ),
				'parent'        => $search_page_panel,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'musea' ),
					'full-width' => esc_html__( 'Full Width', 'musea' )
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'search_page_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'musea' ),
				'description'   => esc_html__( "Choose a sidebar layout for search page", 'musea' ),
				'default_value' => 'no-sidebar',
				'options'       => musea_elated_get_custom_sidebars_options(),
				'parent'        => $search_page_panel
			)
		);
		
		$musea_custom_sidebars = musea_elated_get_custom_sidebars();
		if ( count( $musea_custom_sidebars ) > 0 ) {
			musea_elated_add_admin_field(
				array(
					'name'        => 'search_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'musea' ),
					'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'musea' ),
					'parent'      => $search_page_panel,
					'options'     => $musea_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		$search_panel = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'musea' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen',
				'label'         => esc_html__( 'Select Search Type', 'musea' ),
				'description'   => esc_html__( "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'musea' ),
				'options'       => musea_elated_get_search_types_options()
			)
		);

        musea_elated_add_admin_field(
            array(
                'parent'      => $search_panel,
                'type'        => 'image',
                'name'        => 'fullscreen_search_background_image',
                'label'       => esc_html__( 'Background Image', 'musea' ),
                'description' => esc_html__( 'Choose a background image for full screen search background', 'musea' ),
                'dependency' => array(
                    'show' => array(
                        'search_type' => 'fullscreen'
                    )
                )
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'      => $search_panel,
                'type'        => 'image',
                'name'        => 'fullscreen_search_pattern_image',
                'label'       => esc_html__( 'Pattern Background Image', 'musea' ),
                'description' => esc_html__( 'Choose a pattern image for full screen search background', 'musea' ),
                'dependency' => array(
                    'show' => array(
                        'search_type' => 'fullscreen'
                    )
                )
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'      => $search_panel,
                'type'        => 'image',
                'name'        => 'fullscreen_search_passepartout_image',
                'label'       => esc_html__( 'Passepartout Background Image', 'musea' ),
                'description' => esc_html__( 'Choose an image for full screen search passepartout', 'musea' ),
                'dependency' => array(
                    'show' => array(
                        'search_type' => 'fullscreen'
                    )
                )
            )
        );

		musea_elated_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Search Icon Source', 'musea' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'musea' ),
				'options'       => musea_elated_get_icon_sources_array( false, false )
			)
		);

		$search_icon_pack_container = musea_elated_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $search_icon_pack_container,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Search Icon Pack', 'musea' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'musea' ),
				'options'       => musea_elated_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$search_svg_path_container = musea_elated_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'svg_path'
					)
				)
			)
		);

		musea_elated_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_icon_svg_path',
				'label'       => esc_html__( 'Search Icon SVG Path', 'musea' ),
				'description' => esc_html__( 'Enter your search icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'musea' ),
			)
		);

		musea_elated_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_close_icon_svg_path',
				'label'       => esc_html__( 'Search Close Icon SVG Path', 'musea' ),
				'description' => esc_html__( 'Enter your search close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'musea' ),
			)
		);

        musea_elated_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'search_sidebar_columns',
                'parent'        => $search_panel,
                'default_value' => '3',
                'label'         => esc_html__( 'Search Sidebar Columns', 'musea' ),
                'description'   => esc_html__( 'Choose number of columns for FullScreen search sidebar area', 'musea' ),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_sidebar_columns_dependency', $dependency_array = array())
					)
				)
            )
        );
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'musea' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'musea' ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_in_grid_dependency', $dependency_array = array())
					)
				)
			)
		);
		
		musea_elated_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'musea' )
			)
		);

		$search_icon_pack_icon_styles_container = musea_elated_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_icon_styles_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $search_icon_pack_icon_styles_container,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'musea' ),
				'description'   => esc_html__( 'Set size for icon', 'musea' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = musea_elated_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'musea' ),
				'description' => esc_html__( 'Define color style for icon', 'musea' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = musea_elated_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'musea' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'musea' )
			)
		);
		
		$enable_search_icon_text_container = musea_elated_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'dependency' => array(
					'show' => array(
						'enable_search_icon_text' => 'yes'
					)
				)
			)
		);
		
		$enable_search_icon_text_group = musea_elated_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'musea' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'musea' )
			)
		);
		
		$enable_search_icon_text_row = musea_elated_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'musea' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'musea' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = musea_elated_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'musea' ),
				'default_value' => '',
				'options'       => musea_elated_get_text_transform_array()
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'musea' ),
				'default_value' => '-1',
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'musea' ),
				'default_value' => '',
				'options'       => musea_elated_get_font_style_array(),
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'musea' ),
				'default_value' => '',
				'options'       => musea_elated_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = musea_elated_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'musea' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_options_map', 'musea_elated_search_options_map', musea_elated_set_options_map_position( 'search' ) );
}