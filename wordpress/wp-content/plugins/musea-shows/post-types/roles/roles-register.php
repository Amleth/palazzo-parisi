<?php

namespace MuseaShows\CPT\Roles;

use MuseaShows\Lib\PostTypeInterface;

/**
 * Class RolesRegister
 * @package MuseaRoles\CPT\Roles
 */
class RolesRegister implements PostTypeInterface {
	private $base;
	private $taxBase;

	public function __construct() {
		$this->base    = 'role-member';
		$this->taxBase = 'role-category';


		add_filter( 'archive_template', array( $this, 'registerArchiveTemplate' ) );
		add_filter( 'single_template', array( $this, 'registerSingleTemplate' ) );
	}
	
	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
		$this->registerTax();
	}
	
	/**
	 * Registers roles archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 *
	 * @param $archive string current template
	 *
	 * @return string string changed template
	 */
	public function registerArchiveTemplate( $archive ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/archive-' . $this->base . '.php' ) ) {
				return MUSEA_SHOWS_CPT_PATH . '/roles/templates/archive-' . $this->base . '.php';
			}
		}
		
		return $archive;
	}
	
	/**
	 * Registers roles single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-role-item.php' ) ) {
				return MUSEA_SHOWS_CPT_PATH . '/roles/templates/single-' . $this->base . '.php';
			}
		}
		
		return $single;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$menuPosition = 5;
		$menuIcon     = 'dashicons-screenoptions';
		$slug         = $this->base;

        if ( musea_core_theme_installed() ) {
            if ( musea_elated_options()->getOptionValue( 'roles_single_slug' ) ) {
                $slug = musea_elated_options()->getOptionValue( 'roles_single_slug' );
            }
        }
		
		register_post_type( $this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__( 'Musea Roles', 'musea-role' ),
					'singular_name' => esc_html__( 'Role Member', 'musea-role' ),
					'add_item'      => esc_html__( 'New Role member', 'musea-role' ),
					'add_new_item'  => esc_html__( 'Add New Role Member', 'musea-role' ),
					'edit_item'     => esc_html__( 'Edit Role Member', 'musea-role' )
				),
				'public'        => true,
                'publicly_queryable'  => false,
				'has_archive'   => true,
				'rewrite'       => array( 'slug' => $slug ),
				'menu_position' => $menuPosition,
				'role_ui'       => true,
				'supports'      => array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes',
					'comments'
				),
				'menu_icon'     => $menuIcon
			)
		);
	}
	
	/**
	 * Registers custom taxonomy with WordPress
	 */
	private function registerTax() {
		$labels = array(
			'name'              => esc_html__( 'Role Categories', 'musea-role' ),
			'singular_name'     => esc_html__( 'Role Category', 'musea-role' ),
			'search_items'      => esc_html__( 'Search Role Categories', 'musea-role' ),
			'all_items'         => esc_html__( 'All Role Categories', 'musea-role' ),
			'parent_item'       => esc_html__( 'Parent Role Category', 'musea-role' ),
			'parent_item_colon' => esc_html__( 'Parent Role Category:', 'musea-role' ),
			'edit_item'         => esc_html__( 'Edit Role Category', 'musea-role' ),
			'update_item'       => esc_html__( 'Update Role Category', 'musea-role' ),
			'add_new_item'      => esc_html__( 'Add New Role Category', 'musea-role' ),
			'new_item_name'     => esc_html__( 'New Role Category Name', 'musea-role' ),
			'menu_name'         => esc_html__( 'Role Categories', 'musea-role' )
		);
		
		register_taxonomy( $this->taxBase, array( $this->base ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'role_ui'           => true,
			'query_var'         => true,
			'role_admin_column' => true,
			'rewrite'           => array( 'slug' => 'roles-category' )
		) );
	}
}