<?php

if ( ! function_exists( 'musea_elated_footer_options_map' ) ) {
	function musea_elated_footer_options_map() {

		musea_elated_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'musea' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'musea' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		musea_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'musea' ),
				'parent'        => $footer_panel
			)
		);

        musea_elated_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'musea' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'musea' ),
                'parent'        => $footer_panel
            )
        );

		musea_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'musea' ),
				'parent'        => $footer_panel
			)
		);
		
		$show_footer_top_container = musea_elated_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		musea_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'musea' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'musea' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		musea_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'musea' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'musea' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'musea' ),
					'left'   => esc_html__( 'Left', 'musea' ),
					'center' => esc_html__( 'Center', 'musea' ),
					'right'  => esc_html__( 'Right', 'musea' )
				),
				'parent'        => $show_footer_top_container
			)
		);
		
		$footer_top_styles_group = musea_elated_add_admin_group(
			array(
				'name'        => 'footer_top_styles_group',
				'title'       => esc_html__( 'Footer Top Styles', 'musea' ),
				'description' => esc_html__( 'Define style for footer top area', 'musea' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		$footer_top_styles_row_1 = musea_elated_add_admin_row(
			array(
				'name'   => 'footer_top_styles_row_1',
				'parent' => $footer_top_styles_group
			)
		);
		
			musea_elated_add_admin_field(
				array(
					'name'   => 'footer_top_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'musea' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			musea_elated_add_admin_field(
				array(
					'name'   => 'footer_top_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'musea' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			musea_elated_add_admin_field(
				array(
					'name'   => 'footer_top_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'musea' ),
					'parent' => $footer_top_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);

		musea_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'musea' ),
				'parent'        => $footer_panel
			)
		);

		$show_footer_bottom_container = musea_elated_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		musea_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'musea' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'musea' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_group = musea_elated_add_admin_group(
			array(
				'name'        => 'footer_bottom_styles_group',
				'title'       => esc_html__( 'Footer Bottom Styles', 'musea' ),
				'description' => esc_html__( 'Define style for footer bottom area', 'musea' ),
				'parent'      => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_row_1 = musea_elated_add_admin_row(
			array(
				'name'   => 'footer_bottom_styles_row_1',
				'parent' => $footer_bottom_styles_group
			)
		);
		
			musea_elated_add_admin_field(
				array(
					'name'   => 'footer_bottom_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'musea' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			musea_elated_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'musea' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			musea_elated_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'musea' ),
					'parent' => $footer_bottom_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);
	}

	add_action( 'musea_elated_action_options_map', 'musea_elated_footer_options_map', musea_elated_set_options_map_position( 'footer' ) );
}