<?php

if ( ! function_exists( 'musea_elated_shows_event_options_map' ) ) {
	function musea_elated_shows_event_options_map() {
		
		$panel_event = musea_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Event Title', 'musea-shows' ),
				'name'  => '$panel_event',
				'page'  => '_shows'
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'        => 'title_event_area_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Height', 'musea-shows' ),
				'description' => esc_html__( 'Set a height for Title Area', 'musea-shows' ),
				'parent'      => $panel_event,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		//do_action('musea_elated_action_shows_plugin_options');
        musea_elated_add_admin_field(
            array(
                'name'        => 'title_event_area_image',
                'type'        => 'image',
                'label'       => esc_html__( 'Title background image', 'musea-shows' ),
                'description' => esc_html__( 'Choose an image from the gallery', 'musea-shows' ),
                'parent'      => $panel_event
            )
        );
	}
	add_action( 'musea_elated_action_shows_plugin_options', 'musea_elated_shows_event_options_map', 11 );
}
