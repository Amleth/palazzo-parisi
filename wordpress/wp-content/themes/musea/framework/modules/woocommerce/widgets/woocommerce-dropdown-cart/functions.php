<?php

if ( ! function_exists( 'musea_elated_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function musea_elated_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'musea_elated_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function musea_elated_get_dropdown_cart_icon_class() {
		$classes = array(
			'eltdf-header-cart'
		);
		
		$classes[] = musea_elated_get_icon_sources_class( 'dropdown_cart', 'eltdf-header-cart' );
		
		return implode( ' ', $classes );
	}
}