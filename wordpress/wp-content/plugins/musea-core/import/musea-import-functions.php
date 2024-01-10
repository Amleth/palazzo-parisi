<?php

if ( ! function_exists( 'musea_core_import_object' ) ) {
	function musea_core_import_object() {
		$musea_core_import_object = new MuseaCoreImport();
	}
	
	add_action( 'init', 'musea_core_import_object' );
}

if ( ! function_exists( 'musea_core_data_import' ) ) {
	function musea_core_data_import() {
		$importObject = MuseaCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "musea/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_musea_core_action_import_content', 'musea_core_data_import' );
}

if ( ! function_exists( 'musea_core_widgets_import' ) ) {
	function musea_core_widgets_import() {
		$importObject = MuseaCoreImport::getInstance();
		
		$folder = "musea/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_musea_core_action_import_widgets', 'musea_core_widgets_import' );
}

if ( ! function_exists( 'musea_core_options_import' ) ) {
	function musea_core_options_import() {
		$importObject = MuseaCoreImport::getInstance();
		
		$folder = "musea/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_musea_core_action_import_options', 'musea_core_options_import' );
}

if ( ! function_exists( 'musea_core_other_import' ) ) {
	function musea_core_other_import() {
		$importObject = MuseaCoreImport::getInstance();
		
		$folder = "musea/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );
		
		$importObject->eltdf_update_meta_fields_after_import( $folder );
		$importObject->eltdf_update_options_after_import( $folder );
		
		if ( musea_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_musea_core_action_import_other_elements', 'musea_core_other_import' );
}