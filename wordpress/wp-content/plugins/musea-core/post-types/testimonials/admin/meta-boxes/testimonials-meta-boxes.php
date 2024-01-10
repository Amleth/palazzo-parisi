<?php

if ( ! function_exists( 'musea_core_map_testimonials_meta' ) ) {
	function musea_core_map_testimonials_meta() {
		$testimonial_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'musea-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'musea-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'musea-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'musea-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'musea-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'musea-core' ),
				'description' => esc_html__( 'Enter author name', 'musea-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'musea-core' ),
				'description' => esc_html__( 'Enter author job position', 'musea-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_core_map_testimonials_meta', 95 );
}