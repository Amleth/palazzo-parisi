<?php

if ( ! function_exists( 'musea_elated_map_post_quote_meta' ) ) {
	function musea_elated_map_post_quote_meta() {
		$quote_post_format_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'musea' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'musea' ),
				'description' => esc_html__( 'Enter Quote text', 'musea' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'musea' ),
				'description' => esc_html__( 'Enter Quote author', 'musea' ),
				'parent'      => $quote_post_format_meta_box
			)
		);

        musea_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_post_quote_author_job_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Quote Author Job', 'musea' ),
                'description' => esc_html__( 'Enter Quote author job', 'musea' ),
                'parent'      => $quote_post_format_meta_box
            )
        );
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_post_quote_meta', 25 );
}