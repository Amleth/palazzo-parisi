<?php

if ( ! function_exists( 'musea_elated_map_sidebar_meta' ) ) {
	function musea_elated_map_sidebar_meta() {
		$eltdf_sidebar_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'musea_elated_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'musea' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'musea' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'musea' ),
				'parent'      => $eltdf_sidebar_meta_box,
                'options'       => musea_elated_get_custom_sidebars_options( true )
			)
		);
		
		$eltdf_custom_sidebars = musea_elated_get_custom_sidebars();
		if ( count( $eltdf_custom_sidebars ) > 0 ) {
			musea_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'musea' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'musea' ),
					'parent'      => $eltdf_sidebar_meta_box,
					'options'     => $eltdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_sidebar_meta', 31 );
}