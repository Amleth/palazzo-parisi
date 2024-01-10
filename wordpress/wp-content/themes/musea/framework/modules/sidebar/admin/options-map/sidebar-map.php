<?php

if ( ! function_exists( 'musea_elated_sidebar_options_map' ) ) {
	function musea_elated_sidebar_options_map() {
		
		musea_elated_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'musea' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'musea' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		musea_elated_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'musea' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'musea' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => musea_elated_get_custom_sidebars_options()
		) );
		
		$musea_custom_sidebars = musea_elated_get_custom_sidebars();
		if ( count( $musea_custom_sidebars ) > 0 ) {
			musea_elated_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'musea' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'musea' ),
				'parent'      => $sidebar_panel,
				'options'     => $musea_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'musea_elated_action_options_map', 'musea_elated_sidebar_options_map', musea_elated_set_options_map_position( 'sidebar' ) );
}