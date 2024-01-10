<?php
namespace MuseaShows\CPT\Shortcodes\Roles;

use MuseaShows\Lib;

class RoleMember implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_role_member';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Portfolio project id filter
	    add_filter( 'vc_autocomplete_eltdf_role_member_member_id_callback', array( &$this, 'roleMemberIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio project id render
	    add_filter( 'vc_autocomplete_eltdf_role_member_member_id_render', array( &$this, 'roleMemberIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
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
			        'name'                      => esc_html__( 'Role Single', 'musea-shows' ),
			        'base'                      => $this->getBase(),
			        'category'                  => esc_html__( 'by MUSEA', 'musea-shows' ),
			        'icon'                      => 'icon-wpb-role-member extended-custom-icon-shows',
			        'allowed_container_element' => 'vc_row',
			        'params'                    => array(
                        array(
					        'type'       => 'autocomplete',
					        'param_name' => 'member_id',
					        'heading'    => esc_html__( 'Select Role Member', 'musea-shows' ),
					        'settings'   => array(
						        'sortable'      => true,
						        'unique_values' => true
					        ),
					        'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'musea-shows' )
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

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'role_member_layout'    => 'info-bellow',
	        'member_id'             => '',
	        'show_image'            => 'yes',
	        'show_social_icons'     => 'no',
	        'social_type'           => 'eltdf-normal',
	        'appear_animation'      => 'yes'
        );

		$params = shortcode_atts($args, $atts);
		extract($params);
	    
	    $params['member_id'] = !empty($params['member_id']) ? $params['member_id'] : get_the_ID();
        $params['image'] = get_the_post_thumbnail($params['member_id']);
        $params['title'] = get_the_title($params['member_id']);
        $params['position'] = get_post_meta($params['member_id'], 'eltdf_role_member_position', true);
	    $params['email'] = get_post_meta($params['member_id'], 'eltdf_role_member_email', true);
        $params['role_social_icons'] = $this->getRoleSocialIcons($params);

        $html = musea_shows_get_cpt_shortcode_module_template_part('roles', 'role-member', $params['role_member_layout'], '', $params);

        return $html;
	}

    private function getRoleSocialIcons($params) {
        $social_icons = array();
		$id = $params['member_id'];
        for($i = 1; $i < 6; $i++) {
            $role_icon_pack = get_post_meta($id, 'eltdf_role_member_social_icon_pack_'.$i, true);
            if($role_icon_pack) {
                $role_icon_collection = musea_elated_icon_collections()->getIconCollection(get_post_meta($id, 'eltdf_role_member_social_icon_pack_' . $i, true));
                $role_social_icon = get_post_meta($id, 'eltdf_role_member_social_icon_pack_' . $i . '_' . $role_icon_collection->param, true);
                $role_social_link = get_post_meta($id, 'eltdf_role_member_social_icon_' . $i . '_link', true);
                $role_social_target = get_post_meta($id, 'eltdf_role_member_social_icon_' . $i . '_target', true);

                if ($role_social_icon !== '') {

                    $role_icon_params = array();
                    $role_icon_params['icon_pack'] = $role_icon_pack;
                    $role_icon_params[$role_icon_collection->param] = $role_social_icon;
                    $role_icon_params['link'] = ($role_social_link !== '') ? $role_social_link : '';
                    $role_icon_params['target'] = ($role_social_target !== '') ? $role_social_target : '';
                    $role_icon_params['type'] = $params['social_type'];
                    
                    $social_icons[] = musea_elated_execute_shortcode('eltdf_icon', $role_icon_params);
                }
            }
        }

        return $social_icons;
    }

	/**
	 * Filter role by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function roleMemberIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'role-member' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

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
	public function roleMemberIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
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