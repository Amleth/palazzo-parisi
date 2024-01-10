<?php

namespace MuseaShows\CPT\Shortcodes\Shows;

use MuseaShows\Lib;

class FullscreenShowGrid implements  Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'eltdf_fullscreen_show_grid';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Show category filter
		add_filter( 'vc_autocomplete_eltdf_fullscreen_show_grid_category_callback', array( &$this, 'showCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Show category render
		add_filter( 'vc_autocomplete_eltdf_fullscreen_show_grid_category_render', array( &$this, 'showCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Show selected projects filter
		add_filter( 'vc_autocomplete_eltdf_fullscreen_show_grid_selected_projects_callback', array( &$this, 'showIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Show selected projects render
		add_filter( 'vc_autocomplete_eltdf_fullscreen_show_grid_selected_projects_render', array( &$this, 'showIdAutocompleteRender', ), 10, 1 ); // Render exact show. Must return an array (label,value)

		//Show tag filter
		add_filter( 'vc_autocomplete_eltdf_fullscreen_show_grid_tag_callback', array( &$this, 'showTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Show tag render
		add_filter( 'vc_autocomplete_eltdf_fullscreen_show_grid_tag_render', array( &$this, 'showTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Fullscreen Show Grid', 'musea-shows' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by MUSEA', 'musea-shows' ),
					'icon'     => 'icon-wpb-fullscreen-show-grid extended-custom-icon-shows',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'musea-shows' ),
							'value'       => array(
								esc_html__( 'Default', 'musea-shows' ) => '',
								esc_html__( 'One', 'musea-shows' )     => '1',
								esc_html__( 'Two', 'musea-shows' )     => '2',
								esc_html__( 'Three', 'musea-shows' )   => '3',
								esc_html__( 'Four', 'musea-shows' )    => '4'
							),
							'description' => esc_html__( 'Default value is Four', 'musea-shows' ),
							'admin_label' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Shows', 'musea-shows' ),
							'description' => esc_html__( 'Set number of items. Enter -1 to show all.', 'musea-shows' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Show Grid', 'musea-shows' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'musea-shows' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_projects',
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'musea-shows' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'musea-shows' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Show Grid', 'musea-shows' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'musea-shows' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'musea-shows' ),
							'value'       => array_flip(musea_elated_get_query_order_by_array()),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'musea-shows' ),
							'value'      => array_flip(musea_elated_get_query_order_array()),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'musea-shows' ),
							'value'      => array_flip( musea_elated_get_title_tag( true ) ),
							'group'      => esc_html__( 'Content Layout', 'musea-shows' )
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_columns'        => '4',
			'number_of_items'          => '-1',
			'category'                 => '',
			'selected_projects'        => '',
			'tag'                      => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'title_tag'                => 'h5',
			'enable_title'             => 'yes',
			'enable_category'          => 'yes'
		);
		$params = shortcode_atts( $args, $atts );

		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params = array();

		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$additional_params['query_results'] = $query_results;

		$number_of_posts_shown = count($query_results->posts);

		$additional_params['holder_classes']       = $this->getHolderClasses( $params );
		$additional_params['holder_data']          = $this->getHolderData( $params, $number_of_posts_shown );

		$params['this_object'] = $this;

		$html = musea_shows_get_cpt_shortcode_module_template_part( 'shows', 'fullscreen-show-grid', 'fullscreen-grid-holder', '',$params, $additional_params );

		return $html;
	}

	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'show-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);

		if ( ! empty( $params['category'] ) ) {
			$query_array['show-category'] = $params['category'];
		}

		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
			$query_array['post__in'] = $project_ids;
		}

		if ( ! empty( $params['tag'] ) ) {
			$query_array['show-tag'] = $params['tag'];
		}

		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}

		return $query_array;
	}

	public function getHolderClasses( $params ) {
		$classes = array();

		$number_of_columns = $params['number_of_columns'];
		switch ( $number_of_columns ):
			case '1':
				$classes[] = 'eltdf-fsg-one-column';
				break;
			case '2':
				$classes[] = 'eltdf-fsg-two-columns';
				break;
			case '3':
				$classes[] = 'eltdf-fsg-three-columns';
				break;
			case '4':
				$classes[] = 'eltdf-fsg-four-columns';
				break;
			case '5':
				$classes[] = 'eltdf-fsg-five-columns';
				break;
			default:
				$classes[] = 'eltdf-fsg-four-columns';
				break;
		endswitch;

		return implode( ' ', $classes );
	}

	public function getHolderData( $params, $number_of_posts_shown ) {
		$data = array();

		if ($params['number_of_columns'] !== ''){
			$data[] = 'data-col-number='.$params['number_of_columns'];
		}

		$data[] = 'data-number-of-posts='.$number_of_posts_shown;

		return implode( ' ', $data );
	}

	public function getItemLink() {
		$show_link_meta = get_post_meta( get_the_ID(), 'show_external_link', true );
		$show_link      = ! empty( $show_link_meta ) ? $show_link_meta : get_permalink( get_the_ID() );

		return apply_filters( 'musea_shows_show_external_link', $show_link );
	}

	public function getItemLinkTarget() {
		$show_link_meta   = get_post_meta( get_the_ID(), 'show_external_link', true );
		$show_link_target = ! empty( $show_link_meta ) ? '_blank' : '_self';

		return apply_filters( 'musea_shows_show_external_link_target', $show_link_target );
	}

	public function getItemBackgroundImage() {
		
		$image_src = get_the_post_thumbnail_url( get_the_ID() );
		$image_meta = get_post_meta( get_the_ID(), 'eltdf_show_list_image_meta', true );
		$show_list_image_id  = ! empty( $image_meta ) ? musea_elated_get_attachment_id_from_url( $image_meta ) : '';
		
		if ( ! empty( $show_list_image_id ) ) {
			 $image = 'background-image: url('.wp_get_attachment_image_url( $show_list_image_id, 'full' ).')';
		}
		else {
			 $image = 'background-image: url('.esc_url($image_src).')';
		}

		return $image;
	}

	/**
	 * Filter show categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function showCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS show_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'show-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['show_category_title'] ) > 0 ) ? esc_html__( 'Category', 'musea-shows' ) . ': ' . $value['show_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find show category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function showCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get show category
			$show_category = get_term_by( 'slug', $query, 'show-category' );
			if ( is_object( $show_category ) ) {

				$show_category_slug  = $show_category->slug;
				$show_category_title = $show_category->name;

				$show_category_title_display = '';
				if ( ! empty( $show_category_title ) ) {
					$show_category_title_display = esc_html__( 'Category', 'musea-shows' ) . ': ' . $show_category_title;
				}

				$data          = array();
				$data['value'] = $show_category_slug;
				$data['label'] = $show_category_title_display;

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
	public function showIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$show_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'show-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $show_id > 0 ? $show_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

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
	 * Find show by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function showIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get show
			$show = get_post( (int) $query );
			if ( ! is_wp_error( $show ) ) {

				$show_id    = $show->ID;
				$show_title = $show->post_title;

				$show_title_display = '';
				if ( ! empty( $show_title ) ) {
					$show_title_display = ' - ' . esc_html__( 'Title', 'musea-shows' ) . ': ' . $show_title;
				}

				$show_id_display = esc_html__( 'Id', 'musea-shows' ) . ': ' . $show_id;

				$data          = array();
				$data['value'] = $show_id;
				$data['label'] = $show_id_display . $show_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter show tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function showTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS show_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'show-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['show_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'musea-shows' ) . ': ' . $value['show_tag_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find show tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function showTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get show category
			$show_tag = get_term_by( 'slug', $query, 'show-tag' );
			if ( is_object( $show_tag ) ) {

				$show_tag_slug  = $show_tag->slug;
				$show_tag_title = $show_tag->name;

				$show_tag_title_display = '';
				if ( ! empty( $show_tag_title ) ) {
					$show_tag_title_display = esc_html__( 'Tag', 'musea-shows' ) . ': ' . $show_tag_title;
				}

				$data          = array();
				$data['value'] = $show_tag_slug;
				$data['label'] = $show_tag_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}