<?php

if ( ! function_exists( 'musea_elated_logo_meta_box_map' ) ) {
	function musea_elated_logo_meta_box_map() {
		
		$logo_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'musea_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'musea' ),
				'name'  => 'logo_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'musea' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'musea' ),
				'parent'      => $logo_meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'musea' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'musea' ),
				'parent'      => $logo_meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'musea' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'musea' ),
				'parent'      => $logo_meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'musea' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'musea' ),
				'parent'      => $logo_meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'musea' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'musea' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_logo_meta_box_map', 47 );
}