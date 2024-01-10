<?php

if ( ! function_exists( 'musea_elated_register_required_plugins' ) ) {
	/**
	 * Registers theme required and optional plugins. Hooks to tgmpa_register hook
	 */
	function musea_elated_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__( 'WPBakery Page Builder', 'musea' ),
				'slug'               => 'js_composer',
				'source'             => get_template_directory() . '/includes/plugins/js_composer.zip',
				'version'            => '6.10.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Revolution Slider', 'musea' ),
				'slug'               => 'revslider',
				'source'             => get_template_directory() . '/includes/plugins/revslider.zip',
				'version'            => '6.6.8',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Musea Core', 'musea' ),
				'slug'               => 'musea-core',
				'source'             => get_template_directory() . '/includes/plugins/musea-core.zip',
				'version'            => '1.0.5',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
            array(
                'name'               => esc_html__('Musea Shows', 'musea'),
                'slug'               => 'musea-shows',
                'source'             => get_template_directory().'/includes/plugins/musea-shows.zip',
                'version'            => '1.0.4',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
			array(
				'name'               => esc_html__( 'Musea Instagram Feed', 'musea' ),
				'slug'               => 'musea-instagram-feed',
				'source'             => get_template_directory() . '/includes/plugins/musea-instagram-feed.zip',
				'version'            => '2.0.3',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Musea Twitter Feed', 'musea' ),
				'slug'               => 'musea-twitter-feed',
				'source'             => get_template_directory() . '/includes/plugins/musea-twitter-feed.zip',
				'version'            => '1.0.2',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'     => esc_html__( 'WooCommerce plugin', 'musea' ),
				'slug'     => 'woocommerce',
				'required' => false
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'musea' ),
				'slug'     => 'contact-form-7',
				'required' => false
			),
            array(
                'name'                  => esc_html__( 'Tickera – WordPress Event Ticketing', 'musea' ),
                'slug'                  => 'tickera-event-ticketing-system',
                'source'                => get_template_directory() . '/includes/plugins/tickera-event-ticketing-system.zip',
                'version'               => '3.5.1.0',
                'required'              => true,
                'force_activation'      => false,
                'force_deactivation'    => false
            ),
			array(
				'name'     => esc_html__( 'Envato Market', 'musea' ),
				'slug'     => 'envato-market',
				'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' => false
			)
		);
		
		$config = array(
			'domain'       => 'musea',
			'default_path' => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'musea' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'musea' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'musea' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'musea' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'musea' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'musea' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'musea' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'musea' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'musea' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'musea' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'musea' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'musea' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'musea' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'musea' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'musea' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'musea' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'musea' ),
				'nag_type'                        => 'updated'
			)
		);
		
		tgmpa( $plugins, $config );
	}
	
	add_action( 'tgmpa_register', 'musea_elated_register_required_plugins' );
}
