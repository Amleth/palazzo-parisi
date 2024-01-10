<?php

if ( ! function_exists( 'musea_elated_search_opener_icon_size' ) ) {
	function musea_elated_search_opener_icon_size() {
		$icon_size = musea_elated_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo musea_elated_dynamic_css( '.eltdf-search-opener', array(
				'font-size' => musea_elated_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_search_opener_icon_size' );
}

if ( ! function_exists( 'musea_elated_search_opener_icon_colors' ) ) {
	function musea_elated_search_opener_icon_colors() {
		$icon_color       = musea_elated_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = musea_elated_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo musea_elated_dynamic_css( '.eltdf-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo musea_elated_dynamic_css( '.eltdf-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_search_opener_icon_colors' );
}

if ( ! function_exists( 'musea_elated_fullscreen_search_general_styles' ) ) {
    function musea_elated_fullscreen_search_general_styles() {

        $background_image              = musea_elated_options()->getOptionValue( 'fullscreen_search_background_image' );
        $background_pattern_image      = musea_elated_options()->getOptionValue( 'fullscreen_search_pattern_image' );
        $background_passepartout_image = musea_elated_options()->getOptionValue( 'fullscreen_search_passepartout_image' );


        if ( ! empty( $background_image ) ) {
            echo musea_elated_dynamic_css( '.eltdf-fullscreen-search-holder', array(
                'background-image'    => 'url(' . esc_url( $background_image ) . ')',
                'background-position' => 'center 0',
                'background-repeat'   => 'no-repeat'
            ) );
        }

        if ( ! empty( $background_pattern_image ) ) {
            echo musea_elated_dynamic_css( '.eltdf-fullscreen-search-holder', array(
                'background-image'    => 'url(' . esc_url( $background_pattern_image ) . ')',
                'background-repeat'   => 'repeat',
                'background-position' => '0 0'
            ) );
        }

        if ( ! empty( $background_passepartout_image ) ) {
            echo musea_elated_dynamic_css( '.eltdf-fullscreen-search-holder', array(
                'background-image'    => 'url(' . esc_url( $background_passepartout_image ) . ')',
                'background-position' => 'center 0',
                'background-repeat'   => 'no-repeat',
                'padding'             => '35px',
                'box-sizing'          => 'border-box',
            ) );
        }
    }

    add_action( 'musea_elated_action_style_dynamic', 'musea_elated_fullscreen_search_general_styles' );
}

if ( ! function_exists( 'musea_elated_search_opener_text_styles' ) ) {
	function musea_elated_search_opener_text_styles() {
		$item_styles = musea_elated_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.eltdf-search-icon-text'
		);
		
		echo musea_elated_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = musea_elated_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo musea_elated_dynamic_css( '.eltdf-search-opener:hover .eltdf-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_search_opener_text_styles' );
}