<?php
namespace MuseaShows\CPT\Shortcodes\Shows;

use MuseaShows\Lib;

class ShowList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_show_list';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Show category filter
	    add_filter( 'vc_autocomplete_eltdf_show_list_category_callback', array( &$this, 'showCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Show category render
	    add_filter( 'vc_autocomplete_eltdf_show_list_category_render', array( &$this, 'showCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Show selected projects filter
	    add_filter( 'vc_autocomplete_eltdf_show_list_selected_shows_callback', array( &$this, 'showIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Show selected projects render
	    add_filter( 'vc_autocomplete_eltdf_show_list_selected_shows_render', array( &$this, 'showIdAutocompleteRender', ), 10, 1 ); // Render exact show. Must return an array (label,value)
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Show List', 'musea-shows' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by MUSEA', 'musea-shows' ),
				    'icon'                      => 'icon-wpb-show-list extended-custom-icon-shows',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'type',
						    'heading'     => esc_html__( 'Show List Template', 'musea-shows' ),
						    'value'       => array(
							    esc_html__( 'Gallery', 'musea-shows' ) => 'gallery',
							    esc_html__( 'Masonry', 'musea-shows' ) => 'masonry'
						    ),
						    'save_always' => true,
						    'admin_label' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'number_of_columns',
						    'heading'     => esc_html__( 'Number of Columns', 'musea-shows' ),
						    'value'       => array(
							    esc_html__( 'Default', 'musea-shows' ) => '',
							    esc_html__( 'One', 'musea-shows' )     => '1',
							    esc_html__( 'Two', 'musea-shows' )     => '2',
							    esc_html__( 'Three', 'musea-shows' )   => '3',
							    esc_html__( 'Four', 'musea-shows' )    => '4',
							    esc_html__( 'Five', 'musea-shows' )    => '5'
						    ),
						    'description' => esc_html__( 'Default value is Three', 'musea-shows' )
					    ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__( 'Space Between Items', 'musea-shows' ),
                            'value'       => array_flip( musea_elated_get_space_between_items_array() ),
                            'save_always' => true
                        ),
					    array(
						    'type'        => 'textfield',
						    'param_name'  => 'number_of_items',
						    'heading'     => esc_html__( 'Number of show singles per page', 'musea-shows' ),
						    'description' => esc_html__( 'Set number of items for your show list. Enter -1 to show all.', 'musea-shows' ),
						    'value'       => '-1'
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'image_proportions',
						    'heading'     => esc_html__( 'Image Proportions', 'musea-shows' ),
						    'value'       => array(
							    esc_html__( 'Original', 'musea-shows' )  => 'full',
							    esc_html__( 'Square', 'musea-shows' )    => 'musea_elated_image_square',
							    esc_html__( 'Landscape', 'musea-shows' ) => 'musea_elated_image_landscape',
							    esc_html__( 'Portrait', 'musea-shows' )  => 'musea_elated_image_portrait',
							    esc_html__( 'Medium', 'musea-shows' )    => 'medium',
							    esc_html__( 'Large', 'musea-shows' )     => 'musea_elated_image_huge'
						    ),
						    'description' => esc_html__( 'Set image proportions for your show list.', 'musea-shows' ),
						    'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery' ) )
					    ),
					
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'enable_fixed_proportions',
						    'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'musea-shows' ),
						    'value'       => array_flip( musea_elated_get_yes_no_select_array( false ) ),
						    'description' => esc_html__( 'Set predefined image proportions for your masonry show list. This option will apply image proportions you set in Show Single page - dimensions for masonry option.', 'musea-core' ),
						    'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Show List', 'musea-shows' ),
						    'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'musea-shows' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'selected_shows',
						    'heading'     => esc_html__( 'Show Only Shows with Listed IDs', 'musea-shows' ),
						    'settings'    => array(
							    'multiple'      => true,
							    'sortable'      => true,
							    'unique_values' => true
						    ),
						    'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'musea-shows' )
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'title_tag',
						    'heading'    => esc_html__( 'Title Tag', 'musea-shows' ),
						    'value'      => array_flip( musea_elated_get_title_tag( true ) ),
						    'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
						    'group' => esc_html__('Layout', 'musea-shows')
					    ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'show_category',
                            'heading'    => esc_html__( 'Show category', 'musea-shows' ),
                            'value'      => array_flip( musea_elated_get_yes_no_select_array( false, false ) ),
                            'group' => esc_html__('Layout', 'musea-shows')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'show_date_range',
                            'heading'    => esc_html__( 'Show date range', 'musea-shows' ),
                            'value'      => array_flip( musea_elated_get_yes_no_select_array( false, false ) ),
                            'group' => esc_html__('Layout', 'musea-shows')
                        ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'orderby',
						    'heading'     => esc_html__('Order By', 'musea-shows'),
						    'value'       => array_flip(musea_elated_get_query_order_by_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'order',
						    'heading'    => esc_html__('Order', 'musea-shows'),
						    'value'      => array_flip(musea_elated_get_query_order_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'show_single_layout',
						    'heading'     => esc_html__('Show Layout', 'musea-shows'),
						    'value'       => array(
							    esc_html__('Info Bellow', 'musea-shows')   => 'info-bellow',
							    esc_html__('Info on Hover', 'musea-shows') => 'info-hover'
						    ),
						    'group' => esc_html__('Layout', 'musea-shows')
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'pagination_type',
						    'heading'    => esc_html__( 'Pagination Type', 'musea-core' ),
						    'value'      => array(
							    esc_html__( 'None', 'musea-core' )            => 'no-pagination',
							    esc_html__( 'Standard', 'musea-core' )        => 'standard',
							    esc_html__( 'Load More', 'musea-core' )       => 'load-more',
							    esc_html__( 'Infinite Scroll', 'musea-core' ) => 'infinite-scroll'
						    ),
						    'group'      => esc_html__( 'Additional Features', 'musea-core' )
					    ),
					    array(
						    'type'       => 'textfield',
						    'param_name' => 'load_more_top_margin',
						    'heading'    => esc_html__( 'Load More Top Margin (px or %)', 'musea-core' ),
						    'dependency' => array( 'element' => 'pagination_type', 'value' => array( 'load-more' ) ),
						    'group'      => esc_html__( 'Additional Features', 'musea-core' )
					    )
				    )
			    )
		    );
	    }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'type'                      => 'gallery',
	        'number_of_columns'         => '3',
            'space_between_items'       => 'normal',
	        'number_of_items'           => '-1',
            'category'                  => '',
            'selected_shows'            => '',
	        'title_tag'                 => 'h5',
	        'image_proportions'         => 'full',
	        'enable_fixed_proportions'  => 'no',
	        'show_category'             => 'no',
	        'show_date_range'           => 'no',
            'orderby'                   => 'date',
            'order'                     => 'ASC',
	        'show_single_layout'        => 'info-bellow',
	        'show_slider'               => 'no',
	        'slider_navigation'	        => 'no',
	        'slider_pagination'	        => 'no',
	        'pagination_type'          => 'standard',
	        'load_more_top_margin'     => '',
	        'slider_autoplay'       => 'no'
        );
		$params = shortcode_atts($args, $atts);
	
	    /***
	     * @params query_results
	     * @params holder_data
	     * @params holder_classes
	     */
		$additional_params = array();
	    
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);
	    $additional_params['query_results'] = $query_results;
	    $additional_params['holder_data']          = musea_elated_get_holder_data_for_cpt( $params, $additional_params );

	    $additional_params['holder_classes'] = $this->getHolderClasses($params, $args);
	    $additional_params['inner_classes']  = $this->getInnerClasses($params);
	    $additional_params['data_attrs']     = $this->getDataAttribute($params);
	
	    $params['this_object'] = $this;
	    
	    $html = musea_shows_get_cpt_shortcode_module_template_part('shows', 'show-list', 'show-holder', $params['type'], $params, $additional_params);
	    
        return $html;
	}

	/**
    * Generates show list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'show-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);

		if(!empty($params['category'])){
			$query_array['show-category'] = $params['category'];
		}

		$show_ids = null;
		if (!empty($params['selected_shows'])) {
            $show_ids = explode(',', $params['selected_shows']);
			$query_array['post__in'] = $show_ids;
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	public function getLoadMoreStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['load_more_top_margin'] ) ) {
			$margin = $params['load_more_top_margin'];
			
			if ( musea_elated_string_ends_with( $margin, '%' ) || musea_elated_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin;
			} else {
				$styles[] = 'margin-top: ' . musea_elated_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}

	/**
    * Generates show holder classes
    *
    * @param $params
    *
    * @return string
    */
	public function getHolderClasses($params, $args){
		$classes = array();
		
		$classes[] = ! empty( $params['type'] ) ? 'eltdf-sl-' . $params['type'] : 'eltdf-sl-' . $args['type'];
		$classes[] = $params['enable_fixed_proportions'] === 'yes' ? 'eltdf-masonry-images-fixed' : '';
		
		$number_of_columns   = $params['number_of_columns'];

        $classes[] = !empty($params['space_between_items']) ? 'eltdf-'.$params['space_between_items'].'-space' : 'eltdf-normal-space';

        if($params['show_slider'] !== 'yes') {
            switch ($number_of_columns):
                case '1':
                    $classes[] = 'eltdf-sl-one-columns';
                    break;
                case '2':
                    $classes[] = 'eltdf-sl-two-columns';
                    break;
                case '3':
                    $classes[] = 'eltdf-sl-three-columns';
                    break;
                case '4':
                    $classes[] = 'eltdf-sl-four-columns';
                    break;
                case '5':
                    $classes[] = 'eltdf-sl-five-columns';
                    break;
                default:
                    $classes[] = 'eltdf-sl-three-columns';
                    break;
            endswitch;
        } else {
            $classes[] = 'eltdf-sl-slider';
        }
		
		$classes[] = ! empty( $params['pagination_type'] ) ? 'eltdf-sl-pag-' . $params['pagination_type'] : '';

        return implode(' ', $classes);
	}
	
	/**
	 * Generates show inner classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getInnerClasses($params){
		$classes = array();
		
		if($params['show_slider'] === 'yes') {
			$classes[] = 'eltdf-owl-slider';
		}
		
		return implode(' ', $classes);
	}
	
	public function getArticleClasses( $params ) {
		$classes = array();
		
		$type       = $params['type'];
		
		$image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
		$masonry_size     = get_post_meta( get_the_ID(), 'eltdf_show_masonry_' . $image_proportion . '_dimensions_meta', true );
		
		$classes[] = ! empty( $masonry_size ) && $type === 'masonry' ? 'eltdf-masonry-size-' . esc_attr( $masonry_size ) : '';

		$classes[] = 'show-item';
		$classes[] = 'has-post-thumbnail hentry show-category-exhibition info-bellow';

		$article_classes = get_post_class( $classes );
		
		
		
		return implode( ' ', $article_classes );
	}

    /**
     * Return Show Slider data attribute
     *
     * @param $params
     *
     * @return array
     */

    private function getDataAttribute($params) {
        $data_attrs = array();
	
	    $data_attrs['data-number-of-items']   = !empty($params['number_of_columns']) ? $params['number_of_columns'] : '3';
	    $data_attrs['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
	    $data_attrs['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';
	    $data_attrs['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';

        return $data_attrs;
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
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS show_category_title
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

				$show_category_slug = $show_category->slug;
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
	 * Filter show by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function showIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$show_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'show-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $show_id > 0 ? $show_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'musea-shows' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'musea-shows' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
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
				
				$show_id = $show->ID;
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
}