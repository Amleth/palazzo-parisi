<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * musea_elated_action_header_meta hook
	 *
	 * @see musea_elated_header_meta() - hooked with 10
	 * @see musea_elated_user_scalable_meta - hooked with 10
	 * @see musea_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'musea_elated_action_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php do_action( 'musea_elated_action_after_opening_body_tag' ); ?>
    <div class="eltdf-wrapper">
        <div class="eltdf-wrapper-inner">
            <?php
            /**
             * musea_elated_action_after_wrapper_inner hook
             *
             * @see musea_elated_get_header() - hooked with 10
             * @see musea_elated_get_mobile_header() - hooked with 20
             * @see musea_elated_back_to_top_button() - hooked with 30
             * @see musea_elated_get_header_minimal_full_screen_menu() - hooked with 40
             * @see musea_elated_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'musea_elated_action_after_wrapper_inner' ); ?>
	        
            <div class="eltdf-content" <?php musea_elated_content_elem_style_attr(); ?>>
                <div class="eltdf-content-inner">