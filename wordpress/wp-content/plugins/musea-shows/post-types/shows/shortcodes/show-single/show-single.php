<?php
namespace MuseaShows\CPT\Shortcodes\Shows;

use MuseaShows\Lib;

class ShowSingle implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_show_single';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Show project id filter
	    add_filter( 'vc_autocomplete_eltdf_show_single_show_id_callback', array( &$this, 'showSingleIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Show project id render
	    add_filter( 'vc_autocomplete_eltdf_show_single_show_id_render', array( &$this, 'showSingleIdAutocompleteRender', ), 10, 1 ); // Render exact show. Must return an array (label,value)
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
	        vc_map( array(
			        'name'                      => esc_html__( 'Show Single', 'musea-shows' ),
			        'base'                      => $this->getBase(),
			        'category'                  => esc_html__( 'by MUSEA', 'musea-shows' ),
			        'icon'                      => 'icon-wpb-show-single extended-custom-icon-shows',
			        'allowed_container_element' => 'vc_row',
			        'params'                    => array(
                        array(
					        'type'       => 'autocomplete',
					        'param_name' => 'show_id',
					        'heading'    => esc_html__( 'Select Show Single', 'musea-shows' ),
					        'settings'   => array(
						        'sortable'      => true,
						        'unique_values' => true
					        ),
					        'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'musea-shows' )
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
	                        'description' => esc_html__( 'Set image proportions for your show.', 'musea-shows' ),
	                        'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery' ) ),
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
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'show_id'               => '',
	        'show_single_layout'    => 'info-bellow',
	        'image_proportions'     => 'full',
	        'title_tag'             => 'h5',
	        'article_classes'       => '',
            'show_category'         => 'no',
            'show_date_range'       => 'no'
        );

		$params = shortcode_atts($args, $atts);
		extract($params);
	    
	    $params['show_id'] = !empty($params['show_id']) ? $params['show_id'] : get_the_ID();
        $params['image'] = get_the_post_thumbnail($params['show_id']);
        $params['title'] = get_the_title($params['show_id']);
	    $params['category'] = wp_get_post_terms($params['show_id'], 'show-category');
	    $params['excerpt'] =  wp_get_post_terms($params['show_id'], 'eltdf_eltdf_shows_description');
	    $params['article_classes'] = $this->getArticleClasses( $params );
	    
        $html = musea_shows_get_cpt_shortcode_module_template_part('shows', 'show-single','single-info-bellow', $params['show_single_layout'], $params);

        return $html;
	}
	
	public function getArticleClasses( $params ) {
		
		$layout       = $params['show_single_layout'];
		$extended_classes      = $params['article_classes'];
		
		$extended_classes .= ' ' . $layout;
		
		return $extended_classes;
	}
	
	
	/**
	 * Filter show by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function showSingleIdAutocompleteSuggester( $query ) {
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
	public function showSingleIdAutocompleteRender( $query ) {
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