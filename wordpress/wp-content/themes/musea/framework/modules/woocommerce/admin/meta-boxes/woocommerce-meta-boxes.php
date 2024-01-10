<?php

if ( ! function_exists( 'musea_elated_map_woocommerce_meta' ) ) {
	function musea_elated_map_woocommerce_meta() {
		
		$woocommerce_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'musea' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'musea' ),
				'description' => esc_html__( 'Choose image layout when it appears in Select Product List - Masonry layout shortcode', 'musea' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'musea' ),
					'small'              => esc_html__( 'Small', 'musea' ),
					'large-width'        => esc_html__( 'Large Width', 'musea' ),
					'large-height'       => esc_html__( 'Large Height', 'musea' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'musea' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'musea' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'musea' ),
				'options'       => musea_elated_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'musea' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_woocommerce_meta', 99 );
}