<?php

if ( ! function_exists( 'musea_shows_map_shows_meta' ) ) {
	function musea_shows_map_shows_meta() {

	    $events = musea_shows_get_events_array();
	    $roles  = musea_shows_get_roles_array();

        $musea_show_description = musea_elated_create_meta_box(
            array(
                'scope' => array( 'show-item' ),
                'title' => esc_html__( 'Show General', 'musea-shows' ),
                'name'  => 'show_description'
            )
        );
        musea_elated_create_meta_box_field(
            array(
                'type'        => 'textareahtml',
                'name'        => 'eltdf_shows_description',
                'label'       => esc_html__('Shows Description', 'musea-shows'),
                'description' => esc_html__('Description field', 'musea-shows'),
                'parent'      => $musea_show_description,
            )
        );
		
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'musea-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio shows where image proportion is fixed', 'musea-core' ),
				'default_value' => '',
				'parent'      => $musea_show_description,
				'options'       => array(
					''                   => esc_html__( 'Default', 'musea-core' ),
					'small'              => esc_html__( 'Small', 'musea-core' ),
					'large-width'        => esc_html__( 'Large Width', 'musea-core' ),
					'large-height'       => esc_html__( 'Large Height', 'musea-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'musea-core' )
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'musea-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type shows lists where image proportion is original', 'musea-core' ),
				'default_value' => 'default',
				'parent'        => $musea_show_description,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'musea-core' ),
					'large-width' => esc_html__( 'Large Width', 'musea-core' )
				)
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_show_list_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Show Image', 'musea-shows' ),
				'description' => esc_html__( 'Choose an Image for displaying in show list. If not uploaded, featured image will be shown.', 'musea-shows' ),
				'parent'      => $musea_show_description
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_show_support_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Support Show Image', 'musea-shows' ),
				'description' => esc_html__( 'Choose an Image for displaying in show description.', 'musea-shows' ),
				'parent'      => $musea_show_description
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_show_custom_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Show Support Custom Link', 'musea-shows' ),
				'parent'      => $musea_show_description
			)
		);

        musea_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_show_custom_location',
                'type'        => 'text',
                'label'       => esc_html__( 'Show Location', 'musea-shows' ),
                'description' => esc_html__( 'Enter the address of the show location that will be displayed in sidebar', 'musea-shows' ),
                'parent'      => $musea_show_description
            )
        );

        musea_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_show_custom_location_link',
                'type'        => 'text',
                'label'       => esc_html__( 'Show Location Link', 'musea-shows' ),
                'description' => esc_html__( 'Enter Show map link', 'musea-shows' ),
                'parent'      => $musea_show_description
            )
        );
		
		
		$musea_show_events = musea_elated_create_meta_box(
            array(
                'scope' => array( 'show-item' ),
                'title' => esc_html__( 'Show Events', 'musea-shows' ),
                'name'  => 'show_events'
            )
        );

        musea_elated_add_repeater_field(
            array(
                'name'        => 'eltdf_show_events',
                'parent'      => $musea_show_events,
                'button_text' => esc_html__( 'Add New Event', 'musea-shows' ),
                'fields'      => array(
                    array(
                        'name'        => 'events',
                        'type'        => 'select',
                        'label'       => esc_html__( 'Event', 'musea-shows' ),
                        'options'=> $events,
                        'args' => array(
                            'col_width' => '3'
                        )
                    ),
                )
            )
        );

        $musea_show_roles = musea_elated_create_meta_box(
            array(
                'scope' => array( 'show-item' ),
                'title' => esc_html__( 'Show Roles', 'musea-shows' ),
                'name'  => 'show_roles'
            )
        );

        musea_elated_add_repeater_field(
            array(
                'name'        => 'eltdf_show_roles',
                'parent'      => $musea_show_roles,
                'button_text' => esc_html__( 'Add New Participant Role', 'musea-shows' ),
                'fields'      => array(
                    array(
                        'name' => 'roles_title',
                        'type' => 'text',
                        'label'       => esc_html__( 'Role', 'musea-shows' ),
                        'args' => array(
                            'col_width' => '3'
                        )
                    ),
                    array(
                        'name'        => 'role_member',
                        'type'        => 'repeater',
                        'label'       => esc_html__( 'Role Member', 'musea-shows' ),
                        'button_text' => esc_html__( 'Add New Role Member', 'musea-shows' ),
                        'fields'      => array(
                            array(
                                'name' => 'roles',
                                'type' => 'select',
                                'options'=> $roles,
                                'args' => array(
                                    'col_width' => '3'
                                )
                            )
                        )
                    )
                ),
            )
        );

	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_shows_map_shows_meta', 40 );
}