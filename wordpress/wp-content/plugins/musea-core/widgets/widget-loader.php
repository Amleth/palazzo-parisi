<?php

if ( ! function_exists( 'musea_core_register_widgets' ) ) {
	function musea_core_register_widgets() {
		$widgets = apply_filters( 'musea_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'musea_core_register_widgets' );
}