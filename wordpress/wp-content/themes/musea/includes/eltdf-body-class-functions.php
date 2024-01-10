<?php

if ( ! function_exists( 'musea_elated_theme_version_class' ) ) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function musea_elated_theme_version_class( $classes ) {
		$current_theme = wp_get_theme();
		
		//is child theme activated?
		if ( $current_theme->parent() ) {
			//add child theme version
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-child-ver-' . $current_theme->get( 'Version' );
			
			//get parent theme
			$current_theme = $current_theme->parent();
		}
		
		if ( $current_theme->exists() && $current_theme->get( 'Version' ) != '' ) {
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-ver-' . $current_theme->get( 'Version' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_theme_version_class' );
}

if ( ! function_exists( 'musea_elated_boxed_class' ) ) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function musea_elated_boxed_class( $classes ) {
		$allow_boxed_layout = true;
		$allow_boxed_layout = apply_filters( 'musea_elated_filter_allow_content_boxed_layout', $allow_boxed_layout );
		
		if ( $allow_boxed_layout && musea_elated_get_meta_field_intersect( 'boxed' ) === 'yes' ) {
			$classes[] = 'eltdf-boxed';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_boxed_class' );
}

if ( ! function_exists( 'musea_elated_paspartu_class' ) ) {
	/**
	 * Function that adds classes on body for paspartu layout
	 */
	function musea_elated_paspartu_class( $classes ) {
		$id = musea_elated_get_page_id();
		
		//is paspartu layout turned on?
		if ( musea_elated_get_meta_field_intersect( 'paspartu', $id ) === 'yes' ) {
			$classes[] = 'eltdf-paspartu-enabled';
			
			if ( musea_elated_get_meta_field_intersect( 'disable_top_paspartu', $id ) === 'yes' ) {
				$classes[] = 'eltdf-top-paspartu-disabled';
			}
			
			if ( musea_elated_get_meta_field_intersect( 'enable_fixed_paspartu', $id ) === 'yes' ) {
				$classes[] = 'eltdf-fixed-paspartu-enabled';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_paspartu_class' );
}

if ( ! function_exists( 'musea_elated_page_smooth_scroll_class' ) ) {
	/**
	 * Function that adds classes on body for page smooth scroll
	 */
	function musea_elated_page_smooth_scroll_class( $classes ) {
		//is smooth scroll enabled enabled?
		if ( musea_elated_options()->getOptionValue( 'page_smooth_scroll' ) == 'yes' ) {
			$classes[] = 'eltdf-smooth-scroll';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_page_smooth_scroll_class' );
}

if ( ! function_exists( 'musea_elated_smooth_page_transitions_class' ) ) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function musea_elated_smooth_page_transitions_class( $classes ) {
		$id = musea_elated_get_page_id();
		
		if ( musea_elated_get_meta_field_intersect( 'smooth_page_transitions', $id ) == 'yes' ) {
			$classes[] = 'eltdf-smooth-page-transitions';
			
			if ( musea_elated_get_meta_field_intersect( 'page_transition_preloader', $id ) == 'yes' ) {
				$classes[] = 'eltdf-smooth-page-transitions-preloader';
			}
			
			if ( musea_elated_get_meta_field_intersect( 'page_transition_fadeout', $id ) == 'yes' ) {
				$classes[] = 'eltdf-smooth-page-transitions-fadeout';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_smooth_page_transitions_class' );
}

if ( ! function_exists( 'musea_elated_content_initial_width_body_class' ) ) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function musea_elated_content_initial_width_body_class( $classes ) {
		$initial_content_width = musea_elated_get_meta_field_intersect( 'initial_content_width', musea_elated_get_page_id() );
		
		if ( ! empty( $initial_content_width ) ) {
			$classes[] = $initial_content_width;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_content_initial_width_body_class' );
}

if ( ! function_exists( 'musea_elated_content_grid_body_class' ) ) {
    /**
     * Function that adds grid stripes to the body.
     *
     * @param $classes array of body classes
     *
     * @return array with content grid body class added
     */
    function musea_elated_content_grid_body_class( $classes ) {
        $initial_grid = musea_elated_get_meta_field_intersect( 'page_background_grid', musea_elated_get_page_id() );
        $meta_grid = musea_elated_get_meta_field_intersect( 'eltdf_page_background_grid_meta', musea_elated_get_page_id() );

        if ( $initial_grid == 'yes' && $meta_grid !== 'no' ) {
            $classes[] = 'eltdf-page-background-grid-enabled';
        }
        elseif ($meta_grid == 'yes'){
            $classes[] = 'eltdf-page-background-grid-enabled';
        }

        return $classes;
    }

    add_filter( 'body_class', 'musea_elated_content_grid_body_class' );
}

if ( ! function_exists( 'musea_elated_passepartout_fullscreen_images_body_class' ) ) {
    /**
     * Function that adds grid stripes to the body.
     *
     * @param $classes array of body classes
     *
     * @return array with content grid body class added
     */
    function musea_elated_passepartout_fullscreen_images_body_class( $classes ) {

        $fs_menu_passepartout_image     = musea_elated_get_meta_field_intersect( 'fullscreen_menu_passepartout_image', musea_elated_get_page_id() );
        $fs_menu_background_image       = musea_elated_get_meta_field_intersect( 'fullscreen_menu_background_image', musea_elated_get_page_id() );
        $fs_search_passepartout_image   = musea_elated_get_meta_field_intersect( 'fullscreen_search_passepartout_image', musea_elated_get_page_id() );
        $fs_search_background_image     = musea_elated_get_meta_field_intersect( 'fullscreen_search_background_image', musea_elated_get_page_id() );
        $search_type   = musea_elated_get_meta_field_intersect( 'search_type', musea_elated_get_page_id() );
        $header_type   = musea_elated_get_meta_field_intersect( 'header_type', musea_elated_get_page_id() );


        if ( !empty($fs_menu_passepartout_image) && $header_type == 'header-minimal' ) {
            $classes[] = 'eltdf-fullscreen-menu-with-passepartout';
        }
        if ( !empty($fs_search_passepartout_image) && $search_type == 'fullscreen' ){
            $classes[] = 'eltdf-fullscreen-search-with-passepartout';
        }
        if( !empty($fs_menu_background_image) ){
            $classes[] = 'eltdf-fs-menu-has-bckgr';
        }
        if( !empty($fs_search_background_image) ){
            $classes[] = 'eltdf-fs-search-has-bckgr';
        }

        return $classes;
    }

    add_filter( 'body_class', 'musea_elated_passepartout_fullscreen_images_body_class' );
}

if ( ! function_exists( 'musea_elated_set_content_behind_header_class' ) ) {
	function musea_elated_set_content_behind_header_class( $classes ) {
		$id = musea_elated_get_page_id();
		
		if ( get_post_meta( $id, 'eltdf_page_content_behind_header_meta', true ) === 'yes' ) {
			$classes[] = 'eltdf-content-is-behind-header';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_set_content_behind_header_class' );
}

if ( ! function_exists( 'musea_elated_set_no_google_api_class' ) ) {
	function musea_elated_set_no_google_api_class( $classes ) {
		$google_map_api = musea_elated_options()->getOptionValue( 'google_maps_api_key' );
		
		if ( empty( $google_map_api ) ) {
			$classes[] = 'eltdf-empty-google-api';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_set_no_google_api_class' );
}

if ( ! function_exists( 'musea_elated_wide_menu_body_class' ) ) {
	/**
	 * Function that adds wide menu width control classes to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with wide menu width control body classes added
	 */
	function musea_elated_wide_menu_body_class( $classes ) {
		$wide_dropdown_menu_in_grid      = musea_elated_get_meta_field_intersect( 'wide_dropdown_menu_in_grid', musea_elated_get_page_id() );
		$wide_dropdown_menu_in_grid_meta = get_post_meta( musea_elated_get_page_id(), 'eltdf_wide_dropdown_menu_in_grid_meta', true );
		
		$wide_dropdown_menu_content_in_grid        = musea_elated_get_meta_field_intersect( 'wide_dropdown_menu_content_in_grid', musea_elated_get_page_id() );
		$wide_dropdown_menu_content_in_grid_global = musea_elated_options()->getOptionValue( 'wide_dropdown_menu_content_in_grid' );
		
		if ( $wide_dropdown_menu_in_grid === 'yes' ) {
			$classes[] = 'eltdf-wide-dropdown-menu-in-grid';
		} else if ( ! empty( $wide_dropdown_menu_in_grid_meta ) && $wide_dropdown_menu_content_in_grid === 'yes' || $wide_dropdown_menu_content_in_grid_global === 'yes' ) {
			$classes[] = 'eltdf-wide-dropdown-menu-content-in-grid';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'musea_elated_wide_menu_body_class' );
}

if( ! function_exists('musea_elated_check_if_fs_menu_svg_close_is_empty') ){
    function musea_elated_check_if_fs_menu_svg_close_is_empty( $classes ){
        $svg_option = musea_elated_options()->getOptionValue('fullscreen_menu_icon_source');
        $svg_closer = musea_elated_options()->getOptionValue('fullscreen_menu_close_icon_svg_path');

        if( ! empty( $svg_option ) && $svg_option == 'svg_path' && empty($svg_closer) ){
            $classes[] = 'eltdf-empty-fs-menu-svg-close';
        }

        return $classes;
    }

    add_filter( 'body_class', 'musea_elated_check_if_fs_menu_svg_close_is_empty' );
}

if( ! function_exists('musea_elated_check_if_sidearea_svg_close_is_empty') ){
    function musea_elated_check_if_sidearea_svg_close_is_empty( $classes ){
        $svg_option = musea_elated_options()->getOptionValue('side_area_icon_source');
        $svg_closer = musea_elated_options()->getOptionValue('side_area_close_icon_svg_path');

        if( ! empty( $svg_option ) && $svg_option == 'svg_path' && empty($svg_closer) ){
            $classes[] = 'eltdf-empty-sidearea-svg-close';
        }

        return $classes;
    }

    add_filter( 'body_class', 'musea_elated_check_if_sidearea_svg_close_is_empty' );
}