<?php

namespace MuseaShows\CPT\Shows;

use MuseaShows\Lib\PostTypeInterface;

/**
 * Class ShowsRegister
 * @package MuseaShows\CPT\Shows
 */
class ShowsRegister implements PostTypeInterface {
	private $base;
	private $taxBase;

	public function __construct() {
		$this->base    = 'show-item';
		$this->taxBase = 'show-category';

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
	 * Registers shows archive template if one does'nt exists in theme.
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
				return MUSEA_SHOWS_CPT_PATH . '/shows/templates/archive-' . $this->base . '.php';
			}
		}
		
		return $archive;
	}
	
	/**
	 * Registers shows single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-show-item.php' ) ) {
				return MUSEA_SHOWS_CPT_PATH . '/shows/templates/single-' . $this->base . '.php';
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
            if ( musea_elated_options()->getOptionValue( 'shows_single_slug' ) ) {
                $slug = musea_elated_options()->getOptionValue( 'shows_single_slug' );
            }
        }
		
		register_post_type( $this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__( 'Musea Shows', 'musea-show' ),
					'singular_name' => esc_html__( 'Show Item', 'musea-show' ),
					'add_item'      => esc_html__( 'New Show Item', 'musea-show' ),
					'add_new_item'  => esc_html__( 'Add New Show Item', 'musea-show' ),
					'edit_item'     => esc_html__( 'Edit Show Item', 'musea-show' )
				),
				'public'        => true,
				'has_archive'   => true,
				'rewrite'       => array( 'slug' => $slug ),
				'menu_position' => $menuPosition,
				'show_ui'       => true,
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
			'name'              => esc_html__( 'Show Categories', 'musea-show' ),
			'singular_name'     => esc_html__( 'Show Category', 'musea-show' ),
			'search_items'      => esc_html__( 'Search Show Categories', 'musea-show' ),
			'all_items'         => esc_html__( 'All Show Categories', 'musea-show' ),
			'parent_item'       => esc_html__( 'Parent Show Category', 'musea-show' ),
			'parent_item_colon' => esc_html__( 'Parent Show Category:', 'musea-show' ),
			'edit_item'         => esc_html__( 'Edit Show Category', 'musea-show' ),
			'update_item'       => esc_html__( 'Update Show Category', 'musea-show' ),
			'add_new_item'      => esc_html__( 'Add New Show Category', 'musea-show' ),
			'new_item_name'     => esc_html__( 'New Show Category Name', 'musea-show' ),
			'menu_name'         => esc_html__( 'Show Categories', 'musea-show' )
		);
		
		register_taxonomy( $this->taxBase, array( $this->base ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'shows-category' )
		) );
	}
}