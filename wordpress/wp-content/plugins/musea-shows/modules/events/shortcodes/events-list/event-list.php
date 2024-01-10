<?php

namespace MuseaShows\CPT\Modules\Events\Shortcodes;

use MuseaShows\Lib;

class EventList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_event_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Shows category filter
		add_filter( 'vc_autocomplete_eltdf_event_list_category_callback', array(
			&$this,
			'showsCategoryAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Shows category render
		add_filter( 'vc_autocomplete_eltdf_event_list_category_render', array(
			&$this,
			'showsCategoryAutocompleteRender',
		), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Shows selected projects filter
		add_filter( 'vc_autocomplete_eltdf_event_list_selected_projects_callback', array(
			&$this,
			'showsIdAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Shows selected projects render
		add_filter( 'vc_autocomplete_eltdf_event_list_selected_projects_render', array(
			&$this,
			'showsIdAutocompleteRender',
		), 10, 1 ); // Render exact shows. Must return an array (label,value)
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
				'name'     => esc_html__( 'Event List', 'musea-shows' ),
				'base'     => $this->getBase(),
				'category' => esc_html__( 'by MUSEA', 'musea-shows' ),
				'icon'     => 'icon-wpb-shows extended-custom-icon-shows',
				'params'   => array(
					array(
						'type'        => 'autocomplete',
						'param_name'  => 'category',
						'heading'     => esc_html__( 'One-Category Event List', 'musea-shows' ),
						'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'musea-shows' )
					),
                    array(
                        'type'        => 'attach_image',
                        'param_name'  => 'image',
                        'heading'     => esc_html__( 'Image', 'musea-core' ),
                        'description' => esc_html__( 'Select image from media library', 'musea-core' )
                    ),
					array(
						'type'        => 'autocomplete',
						'param_name'  => 'selected_projects',
						'heading'     => esc_html__( 'Show Only Events with Listed IDs', 'musea-shows' ),
						'settings'    => array(
							'multiple'      => true,
							'sortable'      => true,
							'unique_values' => true
						),
						'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'musea-shows' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'number_of_items',
						'heading'     => esc_html__( 'Number of Events', 'musea-shows' ),
						'description' => esc_html__( 'Set number of items for your shows list. Enter -1 to show all.', 'musea-shows' ),
						'value'       => '-1'
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'orderby',
						'heading'     => esc_html__( 'Order By', 'musea-shows' ),
						'value'       => array_flip( musea_elated_get_query_order_by_array() ),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'order',
						'heading'     => esc_html__( 'Order', 'musea-shows' ),
						'value'       => array_flip( musea_elated_get_query_order_array() ),
						'save_always' => true
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'item_style',
						'heading'    => esc_html__( 'Item Style', 'musea-core' ),
						'value'      => array(
							esc_html__( 'Simple', 'musea-core' )     => 'simple',
							esc_html__( 'With Image', 'musea-core' ) => 'with-image',
						),
						'group'      => esc_html__( 'Content Layout', 'musea-core' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'number_of_columns',
						'heading'     => esc_html__( 'Number of Columns', 'musea-core' ),
						'value'       => array(
							esc_html__( 'Default', 'musea-core' ) => '',
							esc_html__( 'One', 'musea-core' )     => '1',
							esc_html__( 'Two', 'musea-core' )     => '2',
							esc_html__( 'Three', 'musea-core' )   => '3',
							esc_html__( 'Four', 'musea-core' )    => '4',
							esc_html__( 'Five', 'musea-core' )    => '5'
						),
						'description' => esc_html__( 'Default value is Three', 'musea-core' ),
						'save_always' => true,
						'admin_label' => true,
						'group'       => esc_html__( 'Content Layout', 'musea-core' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'space_between_items',
						'heading'     => esc_html__( 'Space Between Items', 'musea-core' ),
						'value'       => array_flip( musea_elated_get_space_between_items_array() ),
						'save_always' => true,
						'group'       => esc_html__( 'Content Layout', 'musea-core' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_tag',
						'heading'    => esc_html__( 'Title Tag', 'musea-core' ),
						'value'      => array_flip( musea_elated_get_title_tag( true ) ),
						'group'      => esc_html__( 'Content Layout', 'musea-core' )
					),
					array(
						'type'        => 'colorpicker',
						'param_name'        => 'button_background_color',
						'heading'       => esc_html__( 'Button Background Color', 'musea-shows' ),
						'description' => esc_html__( 'This option is only for Get Ticket button', 'musea-shows' )
					),
					array(
						'type'        => 'colorpicker',
						'param_name'        => 'button_color',
						'heading'       => esc_html__( 'Button Color', 'musea-shows' ),
						'description' => esc_html__( 'This option is only for Get Ticket button', 'musea-shows' )
					)
				)
			) );
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_items'   => '',
			'image'             => '',
			'category'          => '',
			'selected_projects' => '',
			'orderby'           => '',
			'order'             => '',
			'item_style'        => 'simple',
			'number_of_columns' => '3',
			'space_between_items' => 'normal',
			'title_tag' => 'h4',
			'button_background_color' => '',
			'button_color' => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		/***
		 * @params query_results
		 * @params holder_classes
		 */
		$additional_params = array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$params['holder_classes']           = $this->getHolderClasses( $params, $args );
		$params['this_object']              = $this;
        $params['image']                    = $this->getImage( $params );
		
		$additional_params['query_results'] = $query_results;
		
		$html = musea_shows_get_module_shortcode_template_part( 'events', 'events-list', 'event-holder', '', $params, $additional_params );
		
		return $html;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'tc_events',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['event_category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
			$query_array['post__in'] = $project_ids;
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}

    private function getImage( $params ) {
        $image = array();

        if ( ! empty( $params['image'] ) ) {
            $id = $params['image'];

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src( $id, 'full' );
            $image['url']      = $image_original[0];
            $image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
        }

        return $image;
    }
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		if($params['item_style'] !== 'simple') {
			$classes[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $args['space_between_items'] . '-space';
			
			$number_of_columns = $params['number_of_columns'];
			switch ( $number_of_columns ):
				case '1':
					$classes[] = 'eltdf-el-one-column';
					break;
				case '2':
					$classes[] = 'eltdf-el-two-columns';
					break;
				case '3':
					$classes[] = 'eltdf-el-three-columns';
					break;
				case '4':
					$classes[] = 'eltdf-el-four-columns';
					break;
				case '5':
					$classes[] = 'eltdf-el-five-columns';
					break;
				default:
					$classes[] = 'eltdf-el-three-columns';
					break;
			endswitch;
		}
		
		$classes[] = ! empty( $params['item_style'] ) ? 'eltdf-el-' . $params['item_style'] : '';
		
		return implode( ' ', $classes );
	}
	
	/**
	 * Filter shows categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function showsCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS event_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'event_category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['event_category_title'] ) > 0 ) ? esc_html__( 'Category', 'musea-shows' ) . ': ' . $value['event_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find shows category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function showsCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get shows category
			$shows_category = get_term_by( 'slug', $query, 'event_category' );
			if ( is_object( $shows_category ) ) {
				
				$shows_category_slug  = $shows_category->slug;
				$shows_category_title = $shows_category->name;
				
				$shows_category_title_display = '';
				if ( ! empty( $shows_category_title ) ) {
					$shows_category_title_display = esc_html__( 'Category', 'musea-shows' ) . ': ' . $shows_category_title;
				}
				
				$data          = array();
				$data['value'] = $shows_category_slug;
				$data['label'] = $shows_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter shows by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function showsIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$shows_id        = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'tc_events' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $shows_id > 0 ? $shows_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'musea-shows' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'musea-shows' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find shows by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function showsIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get shows
			$shows = get_post( (int) $query );
			if ( ! is_wp_error( $shows ) ) {
				
				$shows_id    = $shows->ID;
				$shows_title = $shows->post_title;
				
				$shows_title_display = '';
				if ( ! empty( $shows_title ) ) {
					$shows_title_display = ' - ' . esc_html__( 'Title', 'musea-shows' ) . ': ' . $shows_title;
				}
				
				$shows_id_display = esc_html__( 'Id', 'musea-shows' ) . ': ' . $shows_id;
				
				$data          = array();
				$data['value'] = $shows_id;
				$data['label'] = $shows_id_display . $shows_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
}