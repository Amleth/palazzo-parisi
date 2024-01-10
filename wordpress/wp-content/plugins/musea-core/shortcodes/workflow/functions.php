<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltdf_Workflow extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Eltdf_Workflow_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'musea_core_add_workflow_shortcodes' ) ) {
	function musea_core_add_workflow_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MuseaCore\CPT\Shortcodes\Workflow\Workflow',
			'MuseaCore\CPT\Shortcodes\WorkflowItem\WorkflowItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'musea_core_filter_add_vc_shortcode', 'musea_core_add_workflow_shortcodes' );
}

if ( ! function_exists( 'musea_core_set_worklow_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for workflow shortcode
	 */
	function musea_core_set_workflow_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.vc_shortcodes_container.wpb_eltdf_worklof_item { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'musea_core_filter_add_vc_shortcodes_custom_style', 'musea_core_set_workflow_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'musea_core_set_workflow_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for workflow shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function musea_core_set_workflow_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-workflow';
		$shortcodes_icon_class_array[] = '.icon-wpb-workflow-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'musea_core_filter_add_vc_shortcodes_custom_icon_class', 'musea_core_set_workflow_icon_class_name_for_vc_shortcodes' );
}