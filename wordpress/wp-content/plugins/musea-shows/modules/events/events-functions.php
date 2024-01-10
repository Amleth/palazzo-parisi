<?php

if(! function_exists('musea_elated_custom_event_single')) {
    function musea_elated_custom_event_single(){

        if (get_post_type() === 'tc_events') {
            return true;
        }
    }

}
add_filter('musea_elated_filter_custom_single', 'musea_elated_custom_event_single', 10);

if(! function_exists('musea_elated_event_single_template')){

    function musea_elated_event_single_template(){
        musea_shows_get_module_template_part('events', '/single/holder');
    }

    add_action('musea_elated_action_single_path', 'musea_elated_event_single_template', 10);

}

// Load events shortcodes
if ( ! function_exists( 'musea_shows_include_events_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function musea_shows_include_events_shortcodes_files() {
		foreach ( glob( MUSEA_SHOWS_MODULES_PATH . '/events/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'musea_shows_action_include_shortcodes_file', 'musea_shows_include_events_shortcodes_files' );
}

if ( ! function_exists( 'musea_shows_events_title_height' ) ) {
	function musea_shows_events_title_height( $default_height ) {
		
		if ( is_singular( 'tc_events' ) || get_post_type() == 'show-item' && is_archive() )  {

            $event_title_height = musea_elated_options()->getOptionValue('title_event_area_height');

			$default_height      = ! empty( $event_title_height ) ? intval( $event_title_height ) : $default_height;
		}
		return $default_height;
	}
	
	add_filter('musea_elated_filter_title_area_default_height_value', 'musea_shows_events_title_height');
}

if ( ! function_exists( 'musea_shows_events_title_image' ) ) {
    function musea_shows_events_title_image( $event_title_image ) {

        if ( is_singular( 'tc_events' ) || is_singular('show-item') || get_post_type() == 'show-item' ) {
              $event_title_image = musea_elated_options()->getOptionValue('title_event_area_image');
        }
        return $event_title_image;
    }

    add_filter('musea_elated_filter_title_area_image', 'musea_shows_events_title_image');
}