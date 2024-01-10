<?php

if ( ! function_exists( 'musea_elated_roles_options_map' ) ) {
	function musea_elated_roles_options_map() {
		
		$panel_roles_archivee = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Roles Archive', 'musea-shows' ),
				'name'  => 'panel_roles_archive',
				'page'  => '_shows'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'roles_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'musea-shows' ),
				'description' => esc_html__( 'Set number of items for your shows list on archive pages. Default value is 12', 'musea-shows' ),
				'parent'      => $panel_roles_archivee,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'roles_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'musea-shows' ),
				'default_value' => '4',
				'description'   => esc_html__( 'Set number of columns for your roles list on archive pages. Default value is 4 columns', 'musea-shows' ),
				'parent'        => $panel_roles_archivee,
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
				'name'          => 'roles_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'musea-shows' ),
				'description'   => esc_html__( 'Set space size between roles items for your roles list on archive pages. Default value is normal', 'musea-shows' ),
				'default_value' => 'normal',
				'options'       => musea_elated_get_space_between_items_array(),
				'parent'        => $panel_roles_archivee
			)
		);
		
		$panel_roles = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Roles Single', 'musea-shows' ),
				'name'  => 'panel_roles',
				'page'  => '_shows'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'role_title_area_single',
				'default_value' => '',
				'label'         => esc_html__( 'Role Title Area', 'musea-shows' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'musea-shows' ),
				'parent'        => $panel_roles,
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
				'name'        => 'roles_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Roles Single Slug', 'musea-shows' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'musea-shows' ),
				'parent'      => $panel_roles,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_shows_plugin_options', 'musea_elated_roles_options_map', 11 );
}