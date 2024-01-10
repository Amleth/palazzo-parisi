<?php

if ( ! function_exists( 'musea_elated_content_bottom_options_map' ) ) {
	function musea_elated_content_bottom_options_map() {
		
		$panel_content_bottom = musea_elated_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'musea' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'musea' ),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = musea_elated_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_bottom_area'  => 'yes'
					)
				)
			)
		);
		
		$musea_custom_sidebars = musea_elated_get_custom_sidebars();
		
		musea_elated_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'musea' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'musea' ),
				'options'       => $musea_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'musea' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'musea' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'musea' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'musea_elated_action_additional_page_options_map', 'musea_elated_content_bottom_options_map' );
}