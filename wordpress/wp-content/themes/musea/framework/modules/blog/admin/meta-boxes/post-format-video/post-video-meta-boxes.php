<?php

if ( ! function_exists( 'musea_elated_map_post_video_meta' ) ) {
	function musea_elated_map_post_video_meta() {
		$video_post_format_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'musea' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'musea' ),
				'description'   => esc_html__( 'Choose video type', 'musea' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'musea' ),
					'self'            => esc_html__( 'Self Hosted', 'musea' )
				)
			)
		);
		
		$eltdf_video_embedded_container = musea_elated_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'eltdf_video_embedded_container'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'musea' ),
				'description' => esc_html__( 'Enter Video URL', 'musea' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'musea' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'musea' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'musea' ),
				'description' => esc_html__( 'Enter video image', 'musea' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_post_video_meta', 22 );
}