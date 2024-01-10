<?php

if ( ! function_exists( 'musea_elated_map_post_link_meta' ) ) {
	function musea_elated_map_post_link_meta() {
		$link_post_format_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'musea' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'musea' ),
				'description' => esc_html__( 'Enter link', 'musea' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_post_link_meta', 24 );
}