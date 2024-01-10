<?php
namespace MuseaShows\CPT\Shortcodes\Roles;

use MuseaShows\Lib;

class RoleSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_role_slider';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Role category filter
        add_filter( 'vc_autocomplete_eltdf_role_slider_category_callback', array( &$this, 'roleCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Role category render
        add_filter( 'vc_autocomplete_eltdf_role_slider_category_render', array( &$this, 'roleCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Role selected projects filter
        add_filter( 'vc_autocomplete_eltdf_role_slider_selected_projects_callback', array( &$this, 'roleIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Role selected projects render
        add_filter( 'vc_autocomplete_eltdf_role_slider_selected_projects_render', array( &$this, 'roleIdAutocompleteRender', ), 10, 1 ); // Render exact role. Must return an array (label,value)
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Role Slider', 'musea-shows' ),
				    'base'                      => $this->base,
				    'category'                  => esc_html__( 'by MUSEA', 'musea-shows' ),
				    'icon'                      => 'icon-wpb-role-slider extended-custom-icon-shows',
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
						    'heading'     => esc_html__( 'Number of role members per page', 'musea-shows' ),
						    'description' => esc_html__( 'Set number of items for your role list. Enter -1 to show all.', 'musea-shows' ),
						    'value'       => '-1'
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Role List', 'musea-shows' ),
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
						    'type'       => 'dropdown',
						    'param_name' => 'show_social_icons',
						    'heading'    => esc_html__( 'Show Social Icons', 'musea-shows' ),
						    'value'      => array_flip( musea_elated_get_yes_no_select_array( false ) )
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'social_type',
						    'heading'    => esc_html__( 'Type', 'musea-shows' ),
						    'value'      => array(
							    esc_html__( 'Normal', 'musea-shows' ) => 'eltdf-normal',
							    esc_html__( 'Circle', 'musea-shows' ) => 'eltdf-circle',
							    esc_html__( 'Square', 'musea-shows' ) => 'eltdf-square'
						    ),
						    'dependency'  => array( 'element' => 'show_social_icons', 'value' => array('yes') ),
						    'save_always' => true
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
            'category'              => '',
            'selected_projects'     => '',
            'tag'                   => '',
            'orderby'               => 'date',
            'order'                 => 'ASC',
            'role_member_layout'    => 'info-bellow',
            'role_slider'           => 'yes',
            'slider_navigation'	    => 'yes',
            'slider_pagination'	    => 'yes',
            'show_social_icons'     => 'no',
            'social_type'           => 'eltdf-normal'
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['content'] = $content;

        $html = '';
        $html .= '<div class="eltdf-role-slider-holder">';
        $html .= musea_elated_execute_shortcode('eltdf_role_list', $params);
        $html .= '</div>';

        return $html;
    }

    /**
     * Filter role categories
     *
     * @param $query
     *
     * @return array
     */
    public function roleCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS role_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'role-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['role_category_title'] ) > 0 ) ? esc_html__( 'Category', 'musea-shows' ) . ': ' . $value['role_category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find role category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function roleCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get role category
            $role_category = get_term_by( 'slug', $query, 'role-category' );
            if ( is_object( $role_category ) ) {

                $role_category_slug = $role_category->slug;
                $role_category_title = $role_category->name;

                $role_category_title_display = '';
                if ( ! empty( $role_category_title ) ) {
                    $role_category_title_display = esc_html__( 'Category', 'musea-shows' ) . ': ' . $role_category_title;
                }

                $data          = array();
                $data['value'] = $role_category_slug;
                $data['label'] = $role_category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter roles by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function roleIdAutocompleteSuggester( $query ) {
        global $wpdb;
        $role_id = (int) $query;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts}
					WHERE post_type = 'role-member' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $role_id > 0 ? $role_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

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
     * Find role by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function roleIdAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get role
            $role = get_post( (int) $query );
            if ( ! is_wp_error( $role ) ) {

                $role_id = $role->ID;
                $role_title = $role->post_title;

                $role_title_display = '';
                if ( ! empty( $role_title ) ) {
                    $role_title_display = ' - ' . esc_html__( 'Title', 'musea-shows' ) . ': ' . $role_title;
                }

                $role_id_display = esc_html__( 'Id', 'musea-shows' ) . ': ' . $role_id;

                $data          = array();
                $data['value'] = $role_id;
                $data['label'] = $role_id_display . $role_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}