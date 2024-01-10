<?php

if ( ! function_exists( 'musea_elated_shows_cpt_options_map' ) ) {
	function musea_elated_shows_cpt_options_map() {
		
		$panel_archive = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Shows Archive', 'musea-shows' ),
				'name'  => 'panel_shows_archive',
				'page'  => '_shows'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'shows_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'musea-shows' ),
				'description' => esc_html__( 'Set number of items for your shows list on archive pages. Default value is 12', 'musea-shows' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'shows_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'musea-shows' ),
				'default_value' => '4',
				'description'   => esc_html__( 'Set number of columns for your shows list on archive pages. Default value is 4 columns', 'musea-shows' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'2' => esc_html__( '2 Columns', 'musea-shows' ),
					'3' => esc_html__( '3 Columns', 'musea-shows' ),
					'4' => esc_html__( '4 Columns', 'musea-shows' ),
					'5' => esc_html__( '5 Columns', 'musea-shows' )
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'shows_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'musea-shows' ),
				'description'   => esc_html__( 'Set space size between shows items for your shows list on archive pages. Default value is normal', 'musea-shows' ),
				'default_value' => 'normal',
				'options'       => musea_elated_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'shows_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'musea-shows' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your shows list on archive pages. Default value is landscape', 'musea-shows' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'                         => esc_html__( 'Original', 'musea-shows' ),
					'musea_elated_image_landscape' => esc_html__( 'Landscape', 'musea-shows' ),
					'musea_elated_image_portrait'  => esc_html__( 'Portrait', 'musea-shows' ),
					'musea_elated_image_square'    => esc_html__( 'Square', 'musea-shows' ),
					'medium'                       => esc_html__( 'Medium', 'musea-shows' ),
					'musea_elated_image_huge'      => esc_html__( 'Large', 'musea-shows' ),
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'shows_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'musea-shows' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your shows list on archive pages. Default value is Standard - Shader', 'musea-shows' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'info-bellow' => esc_html__( 'Info bellow', 'musea-shows' ),
					'info-hover' => esc_html__( 'Info hover', 'musea-shows' )
				)
			)
		);

        $panel = musea_elated_add_admin_panel(
            array(
                'title' => esc_html__( 'Shows Single', 'musea-core' ),
                'name'  => 'panel_shows_single',
                'page'  => '_shows'
            )
        );
		
		musea_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_shows_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'musea-shows' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'musea-shows' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'musea-shows' ),
					'yes' => esc_html__( 'Yes', 'musea-shows' ),
					'no'  => esc_html__( 'No', 'musea-shows' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'shows_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'musea-shows' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'musea-shows' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'shows_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Shows Single Slug', 'musea-shows' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'musea-shows' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_shows_plugin_options', 'musea_elated_shows_cpt_options_map' );
}