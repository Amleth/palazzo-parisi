<?php

if ( ! function_exists( 'musea_elated_get_subscribe_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function musea_elated_get_subscribe_popup() {

		if ( musea_elated_options()->getOptionValue( 'enable_subscribe_popup' ) === 'yes' && ( musea_elated_options()->getOptionValue( 'subscribe_popup_contact_form' ) !== '' || musea_elated_options()->getOptionValue( 'subscribe_popup_title' ) !== '' ) ) {
			musea_elated_load_subscribe_popup_template();
		}
	}

	//Get subscribe popup HTML
	add_action( 'musea_elated_action_before_page_header', 'musea_elated_get_subscribe_popup' );
}

if ( ! function_exists( 'musea_elated_load_subscribe_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function musea_elated_load_subscribe_popup_template() {
		$parameters                       = array();
		$parameters['title']              = musea_elated_options()->getOptionValue( 'subscribe_popup_title' );
		$parameters['subtitle']           = musea_elated_options()->getOptionValue( 'subscribe_popup_subtitle' );
		$background_image_meta            = musea_elated_options()->getOptionValue( 'subscribe_popup_background_image' );
		$parameters['background_styles']  = ! empty( $background_image_meta ) ? 'background-image: url(' . esc_url( $background_image_meta ) . ')' : '';
		$parameters['contact_form']       = musea_elated_options()->getOptionValue( 'subscribe_popup_contact_form' );
		$parameters['contact_form_style'] = musea_elated_options()->getOptionValue( 'subscribe_popup_contact_form_style' );
		$parameters['enable_prevent']     = musea_elated_options()->getOptionValue( 'enable_subscribe_popup_prevent' );
		$parameters['prevent_behavior']   = musea_elated_options()->getOptionValue( 'subscribe_popup_prevent_behavior' );

		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_prevent'] === 'yes' ? 'eltdf-prevent-enable' : 'eltdf-prevent-disable';
		$holder_classes[] = ! empty( $parameters['prevent_behavior'] ) ? 'eltdf-sp-prevent-' . $parameters['prevent_behavior'] : 'eltdf-sp-prevent-session';
		$holder_classes[] = ! empty( $background_image_meta ) ? 'eltdf-sp-has-image' : '';

		$parameters['holder_classes'] = implode( ' ', $holder_classes );

		musea_elated_get_module_template_part( 'templates/subscribe-popup', 'subscribe-popup', '', $parameters );
	}
}