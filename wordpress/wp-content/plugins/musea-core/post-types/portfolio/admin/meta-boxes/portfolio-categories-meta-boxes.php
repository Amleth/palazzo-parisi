<?php

if ( ! function_exists( 'musea_elated_portfolio_category_additional_fields' ) ) {
	function musea_elated_portfolio_category_additional_fields() {
		
		$fields = musea_elated_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		musea_elated_add_taxonomy_field(
			array(
				'name'   => 'eltdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'musea-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'musea_elated_action_custom_taxonomy_fields', 'musea_elated_portfolio_category_additional_fields' );
}