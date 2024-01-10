<?php

if ( ! function_exists( 'musea_elated_404_header_general_styles' ) ) {
	/**
	 * Generates general custom styles for 404 header area
	 */
	function musea_elated_404_header_general_styles() {
		$background_color        = musea_elated_options()->getOptionValue( '404_menu_area_background_color_header' );
		$background_transparency = musea_elated_options()->getOptionValue( '404_menu_area_background_transparency_header' );
		
		$header_styles = array();
		$menu_selector = array(
			'.error404 .eltdf-page-header .eltdf-menu-area'
		);
		
		if ( ! empty( $background_color ) ) {
			$header_styles['background-color']        = $background_color;
			$header_styles['background-transparency'] = 1;
			
			if ( $background_transparency !== '' ) {
				$header_styles['background-transparency'] = $background_transparency;
			}
			
			echo musea_elated_dynamic_css( $menu_selector, array( 'background-color' => musea_elated_rgba_color( $header_styles['background-color'], $header_styles['background-transparency'] ) . ' !important' ) );
		}
		
		if ( empty( $background_color ) && $background_transparency !== '' ) {
			$header_styles['background-color']        = '#fff';
			$header_styles['background-transparency'] = $background_transparency;
			
			echo musea_elated_dynamic_css( $menu_selector, array( 'background-color' => musea_elated_rgba_color( $header_styles['background-color'], $header_styles['background-transparency'] ) . ' !important' ) );
		}
		
		$border_color = musea_elated_options()->getOptionValue( '404_menu_area_border_color_header' );
		
		$menu_styles = array();
		
		if ( ! empty( $border_color ) ) {
			$menu_styles['border-color'] = $border_color;
		}
		
		echo musea_elated_dynamic_css( $menu_selector, $menu_styles );
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_404_header_general_styles' );
}

if ( ! function_exists( 'musea_elated_404_page_general_styles' ) ) {
	/**
	 * Generates general custom styles for 404 page
	 */
	function musea_elated_404_page_general_styles() {
		$background_color         = musea_elated_options()->getOptionValue( '404_page_background_color' );
		$background_image         = musea_elated_options()->getOptionValue( '404_page_background_image' );
		$pattern_background_image = musea_elated_options()->getOptionValue( '404_page_background_pattern_image' );
		
		$item_styles = array();
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $background_image ) ) {
			$item_styles['background-image']    = 'url(' . $background_image . ')';
			$item_styles['background-position'] = 'center 0';
			$item_styles['background-size']     = 'cover';
			$item_styles['background-repeat']   = 'no-repeat';
		}
		
		if ( ! empty( $pattern_background_image ) ) {
			$item_styles['background-image']    = 'url(' . $pattern_background_image . ')';
			$item_styles['background-position'] = '0 0';
			$item_styles['background-repeat']   = 'repeat';
		}
		
		$item_selector = array(
			'.error404 .eltdf-content'
		);
		
		echo musea_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_404_page_general_styles' );
}

if ( ! function_exists( 'musea_elated_404_title_styles' ) ) {
	/**
	 * Generates styles for 404 page title
	 */
	function musea_elated_404_title_styles() {
		$item_styles = musea_elated_get_typography_styles( '404_title' );
		
		$item_selector = array(
			'.error404 .eltdf-page-not-found .eltdf-404-title'
		);
		
		echo musea_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_404_title_styles' );
}

if ( ! function_exists( 'musea_elated_404_title_styles_responsive' ) ) {
    function musea_elated_404_title_styles_responsive() {
        $selector = array(
            '.error404 .eltdf-page-not-found .eltdf-404-title'
        );

        $styles = musea_elated_get_responsive_typography_styles( '404_title_responsive' );

        if ( ! empty( $styles ) ) {
            echo musea_elated_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'musea_elated_action_style_dynamic_responsive_680', 'musea_elated_404_title_styles_responsive' );
}

if ( ! function_exists( 'musea_elated_404_subtitle_styles' ) ) {
	/**
	 * Generates styles for 404 page subtitle
	 */
	function musea_elated_404_subtitle_styles() {
		$item_styles = musea_elated_get_typography_styles( '404_subtitle' );
		
		$item_selector = array(
			'.error404 .eltdf-page-not-found .eltdf-404-subtitle'
		);
		
		echo musea_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_404_subtitle_styles' );
}

if ( ! function_exists( 'musea_elated_404_subtitle_styles_responsive' ) ) {
    function musea_elated_404_subtitle_styles_responsive() {
        $selector = array(
            '.error404 .eltdf-page-not-found .eltdf-404-subtitle'
        );

        $styles = musea_elated_get_responsive_typography_styles( '404_subtitle_responsive' );

        if ( ! empty( $styles ) ) {
            echo musea_elated_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'musea_elated_action_style_dynamic_responsive_680', 'musea_elated_404_subtitle_styles_responsive' );
}

if ( ! function_exists( 'musea_elated_404_text_styles' ) ) {
	/**
	 * Generates styles for 404 page text
	 */
	function musea_elated_404_text_styles() {
		$item_styles = musea_elated_get_typography_styles( '404_text' );
		
		$item_selector = array(
			'.error404 .eltdf-page-not-found .eltdf-404-text'
		);
		
		echo musea_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'musea_elated_action_style_dynamic', 'musea_elated_404_text_styles' );
}

if ( ! function_exists( 'musea_elated_404_text_styles_responsive' ) ) {
    function musea_elated_404_text_styles_responsive() {
        $selector = array(
            '.error404 .eltdf-page-not-found .eltdf-404-text'
        );

        $styles = musea_elated_get_responsive_typography_styles( '404_text_responsive' );

        if ( ! empty( $styles ) ) {
            echo musea_elated_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'musea_elated_action_style_dynamic_responsive_680', 'musea_elated_404_text_styles_responsive' );
}