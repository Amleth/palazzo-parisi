<?php

namespace MuseaCore\CPT\Portfolio;

use MuseaCore\Lib\PostTypeInterface;

/**
 * Class PortfolioRegister
 * @package MuseaCore\CPT\Portfolio
 */
class PortfolioRegister implements PostTypeInterface {
	private $base;
	private $taxBase;
	private $tagBase;
	
	public function __construct() {
		$this->base    = 'portfolio-item';
		$this->taxBase = 'portfolio-category';
		$this->tagBase = 'portfolio-tag';
		
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
		$this->registerTagTax();
	}
	
	/**
	 * Registers portfolio archive template if one does'nt exists in theme.
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
				return MUSEA_CORE_CPT_PATH . '/portfolio/templates/archive-' . $this->base . '.php';
			}
		}

		return $archive;
	}
	
	/**
	 * Registers portfolio single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;

		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-portfolio-item.php' ) ) {
				return MUSEA_CORE_CPT_PATH . '/portfolio/templates/single-' . $this->base . '.php';
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
			if ( musea_elated_options()->getOptionValue( 'portfolio_single_slug' ) ) {
				$slug = musea_elated_options()->getOptionValue( 'portfolio_single_slug' );
			}
		}
		
		register_post_type( $this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__( 'Musea Portfolio', 'musea-core' ),
					'singular_name' => esc_html__( 'Portfolio Item', 'musea-core' ),
					'add_item'      => esc_html__( 'New Portfolio Item', 'musea-core' ),
					'add_new_item'  => esc_html__( 'Add New Portfolio Item', 'musea-core' ),
					'edit_item'     => esc_html__( 'Edit Portfolio Item', 'musea-core' )
				),
				'public'        => true,
				'has_single' => true,
				'has_archive'   => false,
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
			'name'              => esc_html__( 'Portfolio Categories', 'musea-core' ),
			'singular_name'     => esc_html__( 'Portfolio Category', 'musea-core' ),
			'search_items'      => esc_html__( 'Search Portfolio Categories', 'musea-core' ),
			'all_items'         => esc_html__( 'All Portfolio Categories', 'musea-core' ),
			'parent_item'       => esc_html__( 'Parent Portfolio Category', 'musea-core' ),
			'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'musea-core' ),
			'edit_item'         => esc_html__( 'Edit Portfolio Category', 'musea-core' ),
			'update_item'       => esc_html__( 'Update Portfolio Category', 'musea-core' ),
			'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'musea-core' ),
			'new_item_name'     => esc_html__( 'New Portfolio Category Name', 'musea-core' ),
			'menu_name'         => esc_html__( 'Portfolio Categories', 'musea-core' )
		);
		
		register_taxonomy( $this->taxBase, array( $this->base ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'portfolio-category' )
		) );
	}
	
	/**
	 * Registers custom tag taxonomy with WordPress
	 */
	private function registerTagTax() {
		$labels = array(
			'name'              => esc_html__( 'Portfolio Tags', 'musea-core' ),
			'singular_name'     => esc_html__( 'Portfolio Tag', 'musea-core' ),
			'search_items'      => esc_html__( 'Search Portfolio Tags', 'musea-core' ),
			'all_items'         => esc_html__( 'All Portfolio Tags', 'musea-core' ),
			'parent_item'       => esc_html__( 'Parent Portfolio Tag', 'musea-core' ),
			'parent_item_colon' => esc_html__( 'Parent Portfolio Tags:', 'musea-core' ),
			'edit_item'         => esc_html__( 'Edit Portfolio Tag', 'musea-core' ),
			'update_item'       => esc_html__( 'Update Portfolio Tag', 'musea-core' ),
			'add_new_item'      => esc_html__( 'Add New Portfolio Tag', 'musea-core' ),
			'new_item_name'     => esc_html__( 'New Portfolio Tag Name', 'musea-core' ),
			'menu_name'         => esc_html__( 'Portfolio Tags', 'musea-core' )
		);
		
		register_taxonomy( $this->tagBase, array( $this->base ), array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'portfolio-tag' )
		) );
	}
}