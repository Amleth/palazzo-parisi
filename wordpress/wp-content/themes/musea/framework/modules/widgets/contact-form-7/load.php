<?php

if ( musea_elated_is_plugin_installed( 'contact-form-7' ) ) {
	include_once MUSEA_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'musea_core_filter_register_widgets', 'musea_elated_register_cf7_widget' );
}

if ( ! function_exists( 'musea_elated_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function musea_elated_register_cf7_widget( $widgets ) {
		$widgets[] = 'MuseaElatedClassContactForm7Widget';
		
		return $widgets;
	}
}