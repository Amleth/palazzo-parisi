<?php
namespace MuseaShows\CPT\Shortcodes\Shows;

use MuseaShows\Lib;

class ShowSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_show_slider';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Show category filter
        add_filter( 'vc_autocomplete_eltdf_show_slider_category_callback', array( &$this, 'showCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Show category render
        add_filter( 'vc_autocomplete_eltdf_show_slider_category_render', array( &$this, 'showCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Show selected projects filter
        add_filter( 'vc_autocomplete_eltdf_show_slider_selected_shows_callback', array( &$this, 'showIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Show selected projects render
        add_filter( 'vc_autocomplete_eltdf_show_slider_selected_shows_render', array( &$this, 'showIdAutocompleteRender', ), 10, 1 ); // Render exact show. Must return an array (label,value)
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Show Slider', 'musea-shows' ),
				    'base'                      => $this->base,
				    'category'                  => esc_html__( 'by MUSEA', 'musea-shows' ),
				    'icon'                      => 'icon-wpb-show-slider extended-custom-icon-shows',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'number_of_columns',
						    'heading'     => esc_html__( 'Number of Columns in Row', 'musea-shows' ),
						    'value'       => array(
							    esc_html__( 'Three', 'musea-shows' ) => '3',
							    esc_html__( 'Four', 'musea-shows' )  => '4',
							    esc_html__( 'Five', 'musea-shows' )  => '5',
							    esc_html__( 'Six', 'musea-shows' )   => '6'
						    ),
						    'save_always' => true
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
						    'heading'     => esc_html__( 'Number of show members per page', 'musea-shows' ),
						    'description' => esc_html__( 'Set number of items for your show list. Enter -1 to show all.', 'musea-shows' ),
						    'value'       => '-1'
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
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Show List', 'musea-shows' ),
						    'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'musea-shows' )
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'title_tag',
						    'heading'    => esc_html__( 'Title Tag', 'musea-shows' ),
						    'value'      => array_flip( musea_elated_get_title_tag( true ) ),
						    'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
						    'group'      => esc_html__( 'Content Layout', 'musea-shows' )
					    ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'show_category',
                            'heading'    => esc_html__( 'Show category', 'musea-shows' ),
                            'value'      => array_flip( musea_elated_get_yes_no_select_array( false, false ) ),
                            'group' => esc_html__('Content Layout', 'musea-shows')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'show_date_range',
                            'heading'    => esc_html__( 'Show date range', 'musea-shows' ),
                            'value'      => array_flip( musea_elated_get_yes_no_select_array( false, false ) ),
                            'group' => esc_html__('Content Layout', 'musea-shows')
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
						    'type'        => 'dropdown',
						    'param_name'  => 'slider_navigation',
						    'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'musea-shows' ),
						    'value'       => array_flip( musea_elated_get_yes_no_select_array( false, true ) ),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'slider_pagination',
						    'heading'     => esc_html__( 'Enable Slider Pagination', 'musea-shows' ),
						    'value'       => array_flip( musea_elated_get_yes_no_select_array( false, true ) ),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'slider_autoplay',
						    'heading'     => esc_html__( 'Enable Slider Autoplay', 'musea-core' ),
						    'value'       => array_flip( musea_elated_get_yes_no_select_array( false, true ) ),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'show_single_layout',
						    'heading'     => esc_html__('Show Layout', 'musea-shows'),
						    'value'       => array(
							    esc_html__('Info Bellow', 'musea-shows')   => 'info-bellow',
							    esc_html__('Info on Hover', 'musea-shows') => 'info-hover'
						    )
					    )
				    )
			    )
		    );
	    }
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_columns'     => '3',
            'space_between_items'   => 'normal',
            'number_of_items'       => '-1',
            'selected_shows'            => '',
            'category'              => '',
            'title_tag'             => 'h4',
            'orderby'               => 'date',
            'order'                 => 'ASC',
            'show_single_layout'    => 'info-bellow',
            'show_slider'           => 'yes',
            'slider_navigation'	    => 'yes',
            'slider_pagination'	    => 'yes',
            'slider_autoplay'       => 'yes',
            'show_category'         => 'no',
            'show_date_range'       => 'no'
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['content'] = $content;

        $html = '';
        $html .= '<div class="eltdf-show-slider-holder">';
        $html .= musea_elated_execute_shortcode('eltdf_show_list', $params);
        $html .= '</div>';

        return $html;
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
     * Filter shows by ID or Title
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