<?php

if ( ! function_exists( 'musea_elated_logo_options_map' ) ) {
	function musea_elated_logo_options_map() {
		
		musea_elated_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'musea' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = musea_elated_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'musea' )
			)
		);
		
		$hide_logo_container = musea_elated_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => MUSEA_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'musea' ),
				'parent'        => $hide_logo_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => MUSEA_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'musea' ),
				'parent'        => $hide_logo_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => MUSEA_ELATED_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'musea' ),
				'parent'        => $hide_logo_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => MUSEA_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'musea' ),
				'parent'        => $hide_logo_container
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => MUSEA_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'musea' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'musea_elated_action_options_map', 'musea_elated_logo_options_map', musea_elated_set_options_map_position( 'logo' ) );
}