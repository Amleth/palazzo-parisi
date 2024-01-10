<?php

if ( ! function_exists( 'musea_core_reviews_map' ) ) {
	function musea_core_reviews_map() {
		
		$reviews_panel = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'musea-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'musea-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'musea-core' ),
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'musea-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'musea-core' ),
			)
		);
	}
	
	add_action( 'musea_elated_action_additional_page_options_map', 'musea_core_reviews_map', 75 ); //one after elements
}