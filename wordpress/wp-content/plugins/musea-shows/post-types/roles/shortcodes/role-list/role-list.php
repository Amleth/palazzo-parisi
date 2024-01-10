<?php
namespace MuseaShows\CPT\Shortcodes\Roles;

use MuseaShows\Lib;

class RoleList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_role_list';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Role category filter
	    add_filter( 'vc_autocomplete_eltdf_role_list_category_callback', array( &$this, 'roleCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Role category render
	    add_filter( 'vc_autocomplete_eltdf_role_list_category_render', array( &$this, 'roleCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Role selected projects filter
	    add_filter( 'vc_autocomplete_eltdf_role_list_selected_members_callback', array( &$this, 'roleIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Role selected projects render
	    add_filter( 'vc_autocomplete_eltdf_role_list_selected_members_render', array( &$this, 'roleIdAutocompleteRender', ), 10, 1 ); // Render exact role. Must return an array (label,value)
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
				    'name'                      => esc_html__( 'Role List', 'musea-shows' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by MUSEA', 'musea-shows' ),
				    'icon'                      => 'icon-wpb-role-list extended-custom-icon-shows',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
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
						    'param_name'  => 'selected_members',
						    'heading'     => esc_html__( 'Show Only Members with Listed IDs', 'musea-shows' ),
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
						    'type'       => 'dropdown',
						    'param_name' => 'show_image',
						    'heading'    => esc_html__( 'Show Feature Image', 'musea-shows' ),
						    'value'      => array_flip( musea_elated_get_yes_no_select_array( false ) )
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
					    ),
					    array(
					    	'type'       => 'dropdown',
					    	'param_name' => 'appear_animation',
					    	'heading'    => esc_html__( 'Appear Animation', 'musea-core' ),
					    	'value'      => array_flip( musea_elated_get_yes_no_select_array( false, true ) )
					    ),
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
	        'number_of_columns'     => '3',
            'space_between_items'   => 'normal',
	        'number_of_items'       => '-1',
            'category'              => '',
            'selected_members'     => '',
	        'tag'                   => '',
            'orderby'               => 'date',
            'order'                 => 'ASC',
	        'role_member_layout'    => 'info-bellow',
	        'role_slider'           => 'no',
	        'slider_navigation'	    => 'no',
	        'slider_pagination'	    => 'no',
	        'show_image'            => 'no',
	        'show_social_icons'     => 'no',
	        'social_type'           => 'eltdf-normal',
	        'appear_animation'		=> 'yes'
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

	    $additional_params['holder_classes'] = $this->getHolderClasses($params);
	    $additional_params['inner_classes']  = $this->getInnerClasses($params);
	    $additional_params['data_attrs']     = $this->getDataAttribute($params);
	
	    $params['this_object'] = $this;
	    
	    $html = musea_shows_get_cpt_shortcode_module_template_part('roles', 'role-list', 'role-holder', '', $params, $additional_params);
	    
	    return $html;
	}

	/**
    * Generates role list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'role-member',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);

		if(!empty($params['category'])){
			$query_array['role-category'] = $params['category'];
		}

		$member_ids = null;
		if (!empty($params['selected_members'])) {
            $member_ids = explode(',', $params['selected_members']);
			$query_array['post__in'] = $member_ids;
		}
		
		return $query_array;
	}

	/**
    * Generates role holder classes
    *
    * @param $params
    *
    * @return string
    */
	public function getHolderClasses($params){
		$classes = array();

		$number_of_columns   = $params['number_of_columns'];

        $classes[] = !empty($params['space_between_items']) ? 'eltdf-'.$params['space_between_items'].'-space' : 'eltdf-normal-space';

        if($params['role_slider'] !== 'yes') {
            switch ($number_of_columns):
                case '1':
                    $classes[] = 'eltdf-rl-one-columns';
                    break;
                case '2':
                    $classes[] = 'eltdf-rl-two-columns';
                    break;
                case '3':
                    $classes[] = 'eltdf-rl-three-columns';
                    break;
                case '4':
                    $classes[] = 'eltdf-rl-four-columns';
                    break;
                case '5':
                    $classes[] = 'eltdf-rl-five-columns';
                    break;
                default:
                    $classes[] = 'eltdf-rl-three-columns';
                    break;
            endswitch;
        } else {
            $classes[] = 'eltdf-rl-slider';
        }

		$classes[] = ( $params['appear_animation'] == 'yes'  && $params['role_slider'] !== 'yes' )? 'eltdf-rl-appear-fx' : '';

        return implode(' ', $classes);
	}
	
	/**
	 * Generates role inner classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getInnerClasses($params){
		$classes = array();
		
		if($params['role_slider'] === 'yes') {
			$classes[] = 'eltdf-owl-slider';
		}
		
		return implode(' ', $classes);
	}

    /**
     * Return Role Slider data attribute
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

        return $data_attrs;
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
	 * Filter role by ID or Title
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