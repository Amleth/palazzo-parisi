<?php

if ( ! function_exists( 'musea_elated_add_product_list_shortcode' ) ) {
	function musea_elated_add_product_list_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'MuseaCore\CPT\Shortcodes\ProductList\ProductList',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'musea_core_filter_add_vc_shortcode', 'musea_elated_add_product_list_shortcode' );
}

if ( ! function_exists( 'musea_elated_set_product_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for product list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function musea_elated_set_product_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-product-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'musea_core_filter_add_vc_shortcodes_custom_icon_class', 'musea_elated_set_product_list_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'musea_elated_add_product_list_into_shortcodes_list' ) ) {
	function musea_elated_add_product_list_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'eltdf_product_list';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'musea_elated_filter_woocommerce_shortcodes_list', 'musea_elated_add_product_list_into_shortcodes_list' );
}