<?php


if ( ! function_exists( 'musea_core_map_role_single_meta' ) ) {
    function musea_core_map_role_single_meta(){

        $shows = musea_shows_get_shows_array();


        $meta_box = musea_elated_create_meta_box(
            array(
                'scope' => 'role-member',
                'title' => esc_html__( 'Role Member Info', 'musea-shows' ),
                'name'  => 'role_meta'
            )
        );
	
	    musea_elated_create_meta_box_field(
		    array(
			    'name'        => 'eltdf_role_list_image_meta',
			    'type'        => 'image',
			    'label'       => esc_html__( 'Show Image', 'musea-shows' ),
			    'description' => esc_html__( 'Choose an Image for displaying in role list. If not uploaded, featured image will be shown.', 'musea-shows' ),
			    'parent'      => $meta_box
		    )
	    );

        musea_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_role_member_position',
                'type'        => 'text',
                'label'       => esc_html__( 'Position', 'musea-shows' ),
                'description' => esc_html__( 'The members\'s role', 'musea-shows' ),
                'parent'      => $meta_box
            )
        );

        musea_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_role_member_email',
                'type'        => 'text',
                'label'       => esc_html__( 'Email', 'musea-shows' ),
                'description' => esc_html__( 'The members\'s email', 'musea-shows' ),
                'parent'      => $meta_box
            )
        );

        for ( $x = 1; $x < 6; $x ++ ) {

            $social_icon_group = musea_elated_add_admin_group(
                array(
                    'name'   => 'eltdf_role_member_social_icon_group' . $x,
                    'title'  => esc_html__( 'Social Link ', 'musea-core' ) . $x,
                    'parent' => $meta_box
                )
            );

            $social_row1 = musea_elated_add_admin_row(
                array(
                    'name'   => 'eltdf_role_member_social_icon_row1' . $x,
                    'parent' => $social_icon_group
                )
            );

            musea_elated_icon_collections()->getIconsMetaBoxOrOption(
                array(
                    'label'            => esc_html__( 'Icon ', 'musea-core' ) . $x,
                    'parent'           => $social_row1,
                    'name'             => 'eltdf_role_member_social_icon_pack_' . $x,
                    'defaul_icon_pack' => '',
                    'type'             => 'meta-box',
                    'field_type'       => 'simple'
                )
            );

            $social_row2 = musea_elated_add_admin_row(
                array(
                    'name'   => 'eltdf_role_member_social_icon_row2' . $x,
                    'parent' => $social_icon_group
                )
            );

            musea_elated_create_meta_box_field(
                array(
                    'type'            => 'textsimple',
                    'label'           => esc_html__( 'Link', 'musea-core' ),
                    'name'            => 'eltdf_role_member_social_icon_' . $x . '_link',
                    'parent'          => $social_row2,
                    'dependency' => array(
                        'hide' => array(
                            'eltdf_role_member_social_icon_pack_'. $x  => ''
                        )
                    )
                )
            );

            musea_elated_create_meta_box_field(
                array(
                    'type'            => 'selectsimple',
                    'label'           => esc_html__( 'Target', 'musea-core' ),
                    'name'            => 'eltdf_role_member_social_icon_' . $x . '_target',
                    'options'         => musea_elated_get_link_target_array(),
                    'parent'          => $social_row2,
                    'dependency' => array(
                        'hide' => array(
                            'eltdf_role_member_social_icon_' . $x . '_link'  => ''
                        )
                    )
                )
            );
        }

        $performance_box = musea_elated_create_meta_box(
            array(
                'scope' => 'role-member',
                'title' => esc_html__( 'Role Performances', 'musea-shows' ),
                'name'  => 'role_performances'
            )
        );

        musea_elated_add_repeater_field(
            array(
                'name'        => 'eltdf_show_performances',
                'parent'      => $performance_box,
                'button_text' => esc_html__( 'Add New Performance', 'musea-shows' ),
                'fields'      => array(
                    array(
                        'name'        => 'shows',
                        'type'        => 'select',
                        'label'       => esc_html__( 'Show', 'musea-shows' ),
                        'options'=> $shows,
                        'args' => array(
                            'col_width' => '3'
                        )
                    ),
                )
            )
        );

    }

    add_action( 'musea_elated_action_meta_boxes_map', 'musea_core_map_role_single_meta', 47 );
}