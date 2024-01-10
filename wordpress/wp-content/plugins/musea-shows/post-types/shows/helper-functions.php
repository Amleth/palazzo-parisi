<?php

if ( ! function_exists( 'musea_shows_shows_meta_box_functions' ) ) {
	function musea_shows_shows_meta_box_functions( $post_types ) {
		$post_types[] = 'show-item';
		
		return $post_types;
	}
	
	add_filter( 'musea_elated_filter_meta_box_post_types_save', 'musea_shows_shows_meta_box_functions' );
	add_filter( 'musea_elated_filter_meta_box_post_types_remove', 'musea_shows_shows_meta_box_functions' );
}

if ( ! function_exists( 'musea_shows_shows_scope_meta_box_functions' ) ) {
	function musea_shows_shows_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'show-item';
		
		return $post_types;
	}
	
	add_filter( 'musea_elated_filter_set_scope_for_meta_boxes', 'musea_shows_shows_scope_meta_box_functions' );
}

if ( ! function_exists( 'musea_shows_show_add_social_share_option' ) ) {
	function musea_shows_show_add_social_share_option( $container ) {
		musea_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_show-item',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Item', 'musea-shows' ),
				'description'   => esc_html__( 'Show Social Share for Show Items', 'musea-shows' ),
				'parent'        => $container
			)
		);
	}
	
	add_action( 'musea_elated_action_post_types_social_share', 'musea_shows_show_add_social_share_option', 10, 1 );
}

if ( ! function_exists( 'musea_shows_register_shows_cpt' ) ) {
	function musea_shows_register_shows_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'MuseaShows\CPT\Shows\ShowsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'musea_shows_filter_register_custom_post_types', 'musea_shows_register_shows_cpt' );
}

// Load shows shortcodes
if ( ! function_exists( 'musea_shows_include_shows_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function musea_shows_include_shows_shortcodes_files() {
		foreach ( glob( MUSEA_SHOWS_CPT_PATH . '/shows/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'musea_shows_action_include_shortcodes_file', 'musea_shows_include_shows_shortcodes_files' );
}

if ( ! function_exists( 'musea_shows_single_shows_title_display' ) ) {
	/**
	 * Function that checks option for single shows title and overrides it with filter
	 */
	function musea_shows_single_shows_title_display( $show_title_area ) {
		if ( is_singular( 'show-item' ) ) {
			//Override displaying title based on shows option
			$show_title_area_meta = musea_elated_get_meta_field_intersect( 'show_title_area_shows_single' );
			
			if ( ! empty( $show_title_area_meta ) ) {
				$show_title_area = $show_title_area_meta == 'yes' ? true : false;
			}
		}
		return $show_title_area;
	}
	
	add_filter( 'musea_elated_filter_show_title_area', 'musea_shows_single_shows_title_display' );
}

if ( ! function_exists( 'musea_shows_set_breadcrumbs_output_for_shows' ) ) {
	function musea_shows_set_breadcrumbs_output_for_shows( $childContent, $delimiter, $before, $after ) {
		
		if ( is_tax( 'shows-category' ) || is_tax( 'shows-tag' ) ) {
			$childContent = '';
			
			$musea_taxonomy_id        = get_queried_object_id();
			$musea_taxonomy_type      = is_tax( 'shows-tag' ) ? 'shows-tag' : 'shows-category';
			$musea_taxonomy           = ! empty( $musea_taxonomy_id ) ? get_term_by( 'id', $musea_taxonomy_id, $musea_taxonomy_type ) : '';
			$musea_taxonomy_parent_id = isset( $musea_taxonomy->parent ) && $musea_taxonomy->parent !== 0 ? $musea_taxonomy->parent : '';
			$musea_taxonomy_parent    = $musea_taxonomy_parent_id !== '' ? get_term_by( 'id', $musea_taxonomy_parent_id, $musea_taxonomy_type ) : '';
			
			if ( ! empty( $musea_taxonomy_parent ) ) {
				$childContent .= '<a itemprop="url" href="' . get_term_link( $musea_taxonomy_parent->term_id ) . '">' . $musea_taxonomy_parent->name . '</a>' . $delimiter;
			}
			
			if ( ! empty( $musea_taxonomy ) ) {
				$childContent .= $before . esc_attr( $musea_taxonomy->name ) . $after;
			}
			
		} elseif ( is_singular( 'show-item' ) ) {
			$shows_categories = wp_get_post_terms( musea_elated_get_page_id(), 'show-category' );
			$childContent     = '';
			
			if ( ! empty( $shows_categories ) && count( $shows_categories ) ) {
				foreach ( $shows_categories as $cat ) {
					$childContent .= '<a itemprop="url" href="' . get_term_link( $cat->term_id ) . '">' . $cat->name . '</a>' . $delimiter;
				}
			}
			
			$childContent .= $before . get_the_title() . $after;
		}
		
		return $childContent;
	}
	
	add_filter( 'musea_elated_filter_breadcrumbs_title_child_output', 'musea_shows_set_breadcrumbs_output_for_shows', 10, 4 );
}

if ( ! function_exists( 'musea_shows_set_single_shows_comments_enabled' ) ) {
	function musea_shows_set_single_shows_comments_enabled( $comments ) {
		if ( is_singular( 'show-item' ) && musea_elated_options()->getOptionValue( 'shows_single_comments' ) == 'yes' ) {
			$comments = true;
		}
		
		return $comments;
	}
	
	add_filter( 'musea_elated_filter_post_type_comments', 'musea_shows_set_single_shows_comments_enabled', 10, 1 );
}

if ( ! function_exists( 'musea_shows_get_single_shows' ) ) {
	function musea_shows_get_single_shows() {
		
		$events_array = array();
		$events       = get_post_meta( get_the_ID(), 'eltdf_show_events', true );
		if ( ! empty( $events ) ) {
			foreach ( $events as $event ) {
				$events_array[] = $event['events'];
			}
		}
		
		$roles_array = array();
		$roles       = get_post_meta( get_the_ID(), 'eltdf_show_roles', true );
		if ( ! empty( $roles ) ) {
			foreach ( $roles as $role ) {
				
				$temp_array = array();

				if( ! empty($role['role_member']) ) {
                    foreach ($role['role_member'] as $role_item) {
                        $temp_array[] = $role_item['roles'];
                    }
                }
				
				$roles_array[ $role['roles_title'] ] = $temp_array;
			}
		}
		
		$params = array(
			'events'         => $events_array,
			'roles'          => $roles_array,
			'holder_classes' => ''
		);
		
		musea_shows_get_cpt_single_module_template_part( 'templates/single/holder', 'shows', '', $params );
	}
}

if ( ! function_exists( 'musea_shows_add_shows_to_search_types' ) ) {
	function musea_shows_add_shows_to_search_types( $post_types ) {
		
		$post_types['show-item'] = esc_html__( 'Shows', 'musea-shows' );
		
		return $post_types;
	}
	
	add_filter( 'musea_elated_filter_search_post_type_widget_params_post_type', 'musea_shows_add_shows_to_search_types' );
}

if ( ! function_exists( 'musea_shows_get_events_array' ) ) {
	
	function musea_shows_get_events_array() {
		
		$events = array();
		
		if ( musea_shows_is_tickera_installed() ) {
			
			$args = array(
				'post_type'      => 'tc_events',
				'post_statys'    => 'publish',
				'posts_per_page' => - 1
			);
			
			$query = new WP_Query( $args );
			wp_reset_postdata();
			
			if ( $query->have_posts() ) {
				
				while ( $query->have_posts() ) {
					
					$query->the_post();
					
					$events[ get_the_ID() ] = get_the_title();
				}
			}
			
			return $events;
			
		}
		
	}
	
}

if ( ! function_exists( 'musea_shows_get_shows_array' ) ) {
	
	function musea_shows_get_shows_array() {
		
		$shows = array();
		
		$args = array(
			'post_type'      => 'show-item',
			'post_statys'    => 'publish',
			'posts_per_page' => - 1
		);
		
		$query = new WP_Query( $args );
		wp_reset_postdata();
		
		if ( $query->have_posts() ) {
			
			while ( $query->have_posts() ) {
				
				$query->the_post();
				
				$shows[ get_the_ID() ] = get_the_title();
			}
		}
		
		return $shows;
		
	}
	
}

if ( ! function_exists( 'musea_shows_get_archive_shows_list' ) ) {
	function musea_shows_get_archive_shows_list( $musea_taxonomy_slug = '', $musea_taxonomy_name = '' ) {
		$number_of_items        = 12;
		$number_of_items_option = musea_elated_options()->getOptionValue( 'shows_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}
		
		$number_of_columns        = 4;
		$number_of_columns_option = musea_elated_options()->getOptionValue( 'shows_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}
		
		$space_between_items        = 'normal';
		$space_between_items_option = musea_elated_options()->getOptionValue( 'shows_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}
		
		$image_size        = 'landscape';
		$image_size_option = musea_elated_options()->getOptionValue( 'shows_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}
		
		$item_layout        = 'info-bellow';
		$item_layout_option = musea_elated_options()->getOptionValue( 'shows_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_layout = $item_layout_option;
		}
		
		
		$params = array(
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items,
			'image_proportions'   => $image_size,
			'show_single_layout'  => $item_layout,
            'show_date_range'     => 'yes'
		);
		
		$category = ( $musea_taxonomy_name === 'show-category' )  && ! empty( $musea_taxonomy_slug ) ? $musea_taxonomy_slug : '';
		if ( ! empty( $category ) ) {
			$params['category'] = $category;
		}
		
		$html = musea_elated_execute_shortcode( 'eltdf_show_list', $params );
		
		print $html;
	}
}


/**
 * Loads more function for show.
 */
if ( ! function_exists( 'musea_shows_show_ajax_load_more' ) ) {
	function musea_shows_show_ajax_load_more() {
		$shortcode_params = array();
		
		if ( ! empty( $_POST ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key !== '' ) {
					$addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
					$setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );
					
					$shortcode_params[ $setAllLettersToLowercase ] = $value;
				}
			}
		}
		
		$show_list = new \MuseaShows\CPT\Shortcodes\Shows\ShowList();
		
		$query_array                     = $show_list->getQueryArray( $shortcode_params );
		$query_results                   = new \WP_Query( $query_array );
		$shortcode_params['this_object'] = $show_list;
		
		$html = '';
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$shortcode_params['article_classes'] = $show_list->getArticleClasses( $shortcode_params );
				$html .= musea_shows_get_cpt_shortcode_module_template_part('shows', 'show-single', 'single', $shortcode_params['show_single_layout'],  $shortcode_params);
			endwhile;
		else:
			$html .= musea_shows_get_cpt_shortcode_module_template_part( 'shows', 'show-list', 'parts/posts-not-found', '', $shortcode_params );
		endif;
		
		wp_reset_postdata();
		
		$return_obj = array(
			'html' => $html,
		);
		
		echo json_encode( $return_obj );
		exit;
	}
}

add_action( 'wp_ajax_nopriv_musea_shows_show_ajax_load_more', 'musea_shows_show_ajax_load_more' );
add_action( 'wp_ajax_musea_shows_show_ajax_load_more', 'musea_shows_show_ajax_load_more' );