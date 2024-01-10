<?php

if ( ! function_exists( 'musea_elated_map_post_gallery_meta' ) ) {
	
	function musea_elated_map_post_gallery_meta() {
		$gallery_post_format_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'musea' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		musea_elated_add_multiple_images_field(
			array(
				'name'        => 'eltdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'musea' ),
				'description' => esc_html__( 'Choose your gallery images', 'musea' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_post_gallery_meta', 21 );
}
