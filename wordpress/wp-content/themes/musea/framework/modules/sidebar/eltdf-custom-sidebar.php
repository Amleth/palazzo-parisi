<?php

/**
 * Select Sidebar
 * Class for adding custom widget area and choose them on single pages/posts/portfolios
 */
if ( ! class_exists( 'MuseaElatedClassSidebar' ) ) {
	class MuseaElatedClassSidebar {
		var $sidebars = array();
		var $stored = "";
		
		// load needed stuff on widget page
		function __construct() {
			$this->stored = 'eltdf_sidebars';
			$this->title  = esc_html__( 'Custom Widget Area', 'musea' );
			
			add_action( 'load-widgets.php', array( &$this, 'load_assets' ), 5 );
			add_action( 'widgets_init', array( &$this, 'register_custom_sidebars' ), 1000 );
			add_action( 'wp_ajax_eltdf_ajax_delete_custom_sidebar', array( &$this, 'delete_sidebar_area' ), 1000 );
		}
		
		//load css, js and add hooks to the widget page
		function load_assets() {
			add_action( 'admin_print_scripts', array( &$this, 'template_add_widget_field' ) );
			add_action( 'load-widgets.php', array( &$this, 'add_sidebar_area' ), 100 );
			
			wp_enqueue_script( 'musea-select-admin-sidebar', MUSEA_ELATED_ROOT . '/framework/admin/assets/js/eltdf-ui/eltdf-sidebar.js' );
			wp_enqueue_style( 'musea-select-admin-sidebar', MUSEA_ELATED_ROOT . '/framework/admin/assets/css/eltdf-sidebar.css' );
		}
		
		//widget form template
		function template_add_widget_field() {
			$nonce = '<input type="hidden" name="eltdf-delete-sidebar" value="' . wp_create_nonce('eltdf-delete-sidebar') . '" />';
			
			echo "\n<script type='text/html' id='eltdf-add-widget'>";
			echo "\n  <form class='eltdf-add-widget wp-block' method='POST' data-type='core/widget-area'>";
			echo "\n  <h3>" . esc_html($this->title) . "</h3>";
			echo "\n    <span class='input_wrap'><input type='text' value='' placeholder = '" . esc_attr__('Enter Name of the new Widget Area', 'musea') . "' name='eltdf-add-widget' /></span>";
			echo "\n    <input class='button' type='submit' value='" . esc_attr__('Add Widget Area', 'musea') . "' />";
			echo "\n    " . $nonce;
			echo "\n  </form>";
			echo "\n</script>\n";
		}
		
		//add sidebar area to the db
		function add_sidebar_area() {
			if ( ! empty( $_POST['eltdf-add-widget'] ) ) {
				$this->sidebars = get_option( $this->stored );
				$name           = $this->get_name( sanitize_text_field( $_POST['eltdf-add-widget'] ) );
				
				if ( empty( $this->sidebars ) ) {
					$this->sidebars = array( $name );
				} else {
					$this->sidebars = array_merge( $this->sidebars, array( $name ) );
				}
				
				update_option( $this->stored, $this->sidebars );
				wp_redirect( admin_url( 'widgets.php' ) );
				die();
			}
		}
		
		//delete sidebar area from the db
		function delete_sidebar_area() {
			check_ajax_referer( 'eltdf-delete-sidebar' );
			
			if ( ! empty( $_POST['name'] ) ) {
				$name           = stripslashes( sanitize_text_field( $_POST['name'] ) );
				$this->sidebars = get_option( $this->stored );
				
				if ( ( $key = array_search( $name, $this->sidebars ) ) !== false ) {
					unset( $this->sidebars[ $key ] );
					update_option( $this->stored, $this->sidebars );
					echo esc_html__( "sidebar-deleted", 'musea' );
				}
			}
			
			die();
		}
		
		//checks the user submitted name and makes sure that there are no colitions
		function get_name( $name ) {
			if ( empty( $GLOBALS['wp_registered_sidebars'] ) ) {
				return $name;
			}
			
			$taken = array();
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$taken[] = $sidebar['name'];
			}
			
			if ( empty( $this->sidebars ) ) {
				$this->sidebars = array();
			}
			$taken = array_merge( $taken, $this->sidebars );
			
			if ( in_array( $name, $taken ) ) {
				$counter  = substr( $name, - 1 );
				$new_name = ! is_numeric( $counter ) ? $name . " 1" : substr( $name, 0, - 1 ) . ( (int) $counter + 1 );
				$name     = $this->get_name( $new_name );
			}
			
			return $name;
		}
		
		//register custom sidebar areas
		function register_custom_sidebars() {
			if ( empty( $this->sidebars ) ) {
				$this->sidebars = get_option( $this->stored );
			}
			
			$args = array(
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="eltdf-widget-title-holder"><h5 class="eltdf-widget-title">',
				'after_title'   => '</h5></div>'
			);
			
			$args = apply_filters( 'musea_elated_filter_custom_widget_args', $args );
			
			if ( is_array( $this->sidebars ) ) {
				foreach ( $this->sidebars as $sidebar ) {
					$args['name']  = $sidebar;
					$args['id']    = sanitize_title( $sidebar );
					$args['class'] = 'eltdf-custom';
					register_sidebar( $args );
				}
			}
		}
	}
}