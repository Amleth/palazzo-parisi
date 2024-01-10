<?php

if ( ! function_exists( 'musea_shows_roles_meta_box_functions' ) ) {
	function musea_shows_roles_meta_box_functions( $post_types ) {
		$post_types[] = 'role-member';
		
		return $post_types;
	}
	
	add_filter( 'musea_elated_filter_meta_box_post_types_save', 'musea_shows_roles_meta_box_functions' );
	add_filter( 'musea_elated_filter_meta_box_post_types_remove', 'musea_shows_roles_meta_box_functions' );
}

if ( ! function_exists( 'musea_shows_roles_scope_meta_box_functions' ) ) {
	function musea_shows_roles_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'roles-member';
		
		return $post_types;
	}
	
	add_filter( 'musea_elated_filter_set_scope_for_meta_boxes', 'musea_shows_roles_scope_meta_box_functions' );
}

if ( ! function_exists( 'musea_shows_roles_enqueue_meta_box_styles' ) ) {
	function musea_shows_roles_enqueue_meta_box_styles() {
		global $post;
		
		if ( ($post) && ($post->post_type == 'roles-member') ) {
			wp_enqueue_style( 'musea-shows-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}
	}
	
	add_action( 'musea_elated_action_enqueue_meta_box_styles', 'musea_shows_roles_enqueue_meta_box_styles' );
}

if ( ! function_exists( 'musea_shows_register_roles_cpt' ) ) {
	function musea_shows_register_roles_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'MuseaShows\CPT\Roles\RolesRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'musea_shows_filter_register_custom_post_types', 'musea_shows_register_roles_cpt' );
}

// Load roles shortcodes
if(!function_exists('musea_shows_include_roles_shortcodes_files')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function musea_shows_include_roles_shortcodes_files() {
        foreach(glob(MUSEA_SHOWS_CPT_PATH.'/roles/shortcodes/*/load.php') as $shortcode_load) {
            include_once $shortcode_load;
        }
    }

    add_action('musea_shows_action_include_shortcodes_file', 'musea_shows_include_roles_shortcodes_files');
}

if ( ! function_exists( 'musea_shows_single_roles_title_display' ) ) {
	/**
	 * Function that checks option for single shows title and overrides it with filter
	 */
	function musea_shows_single_roles_title_display( $role_title_area ) {
		
		if ( is_singular( 'role-member' ) ) {
			//Override displaying title based on shows option
			$role_title_area_meta = musea_elated_get_meta_field_intersect( 'role_title_area_single', get_the_ID() );
		
			if ( ! empty( $role_title_area_meta ) ) {
				$role_title_area = $role_title_area_meta == 'yes' ? true : false;
			}
		}
		return $role_title_area;
	}
	
	add_filter( 'musea_elated_filter_show_title_area', 'musea_shows_single_roles_title_display' );
}

if ( ! function_exists( 'musea_shows_get_single_roles' ) ) {
	/**
	 * Loads holder template for doctor single
	 */
	function musea_shows_get_single_roles() {
		$roles_member_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => musea_elated_sidebar_layout(),
			'position'       => get_post_meta( $roles_member_id, 'eltdf_role_member_position', true ),
			'social_icons'   => musea_shows_single_roles_social_icons( $roles_member_id ),
		);
		
		musea_shows_get_cpt_single_module_template_part( 'templates/single/holder', 'roles', '', $params );
	}
}

if ( ! function_exists( 'musea_shows_single_roles_social_icons' ) ) {
	function musea_shows_single_roles_social_icons( $id ) {
		$social_icons = array();
		
		for ( $i = 1; $i < 6; $i ++ ) {
			$roles_icon_pack = get_post_meta( $id, 'eltdf_role_member_social_icon_pack_' . $i, true );
			if ( $roles_icon_pack !== '' ) {
				$roles_icon_collection = musea_elated_icon_collections()->getIconCollection( get_post_meta( $id, 'eltdf_role_member_social_icon_pack_' . $i, true ) );
				$roles_social_icon     = get_post_meta( $id, 'eltdf_role_member_social_icon_pack_' . $i . '_' . $roles_icon_collection->param, true );
				$roles_social_link     = get_post_meta( $id, 'eltdf_role_member_social_icon_' . $i . '_link', true );
				$roles_social_target   = get_post_meta( $id, 'eltdf_role_member_social_icon_' . $i . '_target', true );
				
				if ( $roles_social_icon !== '' ) {
					$roles_icon_params                                 = array();
					$roles_icon_params['icon_pack']                    = $roles_icon_pack;
					$roles_icon_params[ $roles_icon_collection->param ] = $roles_social_icon;
					$roles_icon_params['link']                         = ! empty( $roles_social_link ) ? $roles_social_link : '';
					$roles_icon_params['target']                       = ! empty( $roles_social_target ) ? $roles_social_target : '_self';
					
					$social_icons[] = musea_elated_execute_shortcode( 'eltdf_icon', $roles_icon_params );
				}
			}
		}
		
		return $social_icons;
	}
}

if ( ! function_exists( 'musea_shows_get_roles_category_list' ) ) {
	function musea_shows_get_roles_category_list( $category = '' ) {
		$number_of_items        = 12;
		$number_of_items_option = musea_elated_options()->getOptionValue( 'roles_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}
		
		$number_of_columns        = 4;
		$number_of_columns_option = musea_elated_options()->getOptionValue( 'roles_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}
		
		$space_between_items        = 'normal';
		$space_between_items_option = musea_elated_options()->getOptionValue( 'roles_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}
		
		
		$params = array(
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items
		);
		
		if ( ! empty( $category ) ) {
			$params['category'] = $category;
		}

		$html = musea_elated_execute_shortcode( 'eltdf_role_list', $params );
		
		print $html;
	}
}

if ( ! function_exists( 'musea_shows_add_roles_to_search_types' ) ) {
	function musea_shows_add_roles_to_search_types( $post_types ) {
		$post_types['role-member'] = esc_html__( 'Role Member', 'musea-shows' );
		
		return $post_types;
	}
	
	add_filter( 'musea_elated_filter_search_post_type_widget_params_post_type', 'musea_shows_add_roles_to_search_types' );
}

if ( ! function_exists('musea_shows_get_roles_array')){

    function musea_shows_get_roles_array(){

        $shows = array();

        $args = array(
            'post_type'     => 'role-member',
            'post_statys'   => 'publish',
            'posts_per_page' => -1
        );

        $query = new WP_Query($args);
        wp_reset_postdata();

        if($query->have_posts()) {

            while($query->have_posts()) {

                $query->the_post();

                $shows[get_the_ID()] = get_the_title();
            }
        }

        return $shows;

    }

}