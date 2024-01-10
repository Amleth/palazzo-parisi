<?php

if ( ! function_exists( 'musea_elated_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function musea_elated_dropdown_cart_icon_styles() {
		$icon_color       = musea_elated_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = musea_elated_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo musea_elated_dynamic_css( '.eltdf-shopping-cart-holder .eltdf-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo musea_elated_dynamic_css( '.eltdf-shopping-cart-holder .eltdf-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_dropdown_cart_icon_styles' );
}