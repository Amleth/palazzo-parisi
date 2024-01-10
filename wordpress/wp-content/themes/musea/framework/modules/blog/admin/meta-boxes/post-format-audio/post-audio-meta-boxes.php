<?php

if ( ! function_exists( 'musea_elated_map_post_audio_meta' ) ) {
	function musea_elated_map_post_audio_meta() {
		$audio_post_format_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'musea' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'musea' ),
				'description'   => esc_html__( 'Choose audio type', 'musea' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'musea' ),
					'self'            => esc_html__( 'Self Hosted', 'musea' )
				)
			)
		);
		
		$eltdf_audio_embedded_container = musea_elated_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'eltdf_audio_embedded_container'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'musea' ),
				'description' => esc_html__( 'Enter audio URL', 'musea' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'musea' ),
				'description' => esc_html__( 'Enter audio link', 'musea' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_post_audio_meta', 23 );
}