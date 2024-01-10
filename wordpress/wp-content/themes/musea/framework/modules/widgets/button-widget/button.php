<?php

if ( class_exists( 'MuseaCoreClassWidget' ) ) {
	class MuseaElatedClassButtonWidget extends MuseaCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'eltdf_button_widget',
				esc_html__( 'Musea Button Widget', 'musea' ),
				array( 'description' => esc_html__( 'Add button element to widget areas', 'musea' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'musea' ),
					'options' => array(
						'solid'   => esc_html__( 'Solid', 'musea' ),
						'outline' => esc_html__( 'Outline', 'musea' ),
						'simple'  => esc_html__( 'Simple', 'musea' )
					)
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__( 'Size', 'musea' ),
					'options'     => array(
						'small'  => esc_html__( 'Small', 'musea' ),
						'medium' => esc_html__( 'Medium', 'musea' ),
						'large'  => esc_html__( 'Large', 'musea' ),
						'huge'   => esc_html__( 'Huge', 'musea' )
					),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'musea' )
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__( 'Text', 'musea' ),
					'default' => esc_html__( 'Button Text', 'musea' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'musea' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Link Target', 'musea' ),
					'options' => musea_elated_get_link_target_array()
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'musea' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'hover_color',
					'title' => esc_html__( 'Hover Color', 'musea' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'background_color',
					'title'       => esc_html__( 'Background Color', 'musea' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'musea' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_background_color',
					'title'       => esc_html__( 'Hover Background Color', 'musea' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'musea' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'border_color',
					'title'       => esc_html__( 'Border Color', 'musea' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'musea' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_border_color',
					'title'       => esc_html__( 'Hover Border Color', 'musea' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'musea' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'musea' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'musea' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$params = '';
			
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			// Filter out all empty params
			$instance = array_filter( $instance, function ( $array_value ) {
				return trim( $array_value ) != '';
			} );
			
			// Default values
			if ( ! isset( $instance['text'] ) ) {
				$instance['text'] = 'Button Text';
			}
			
			// Generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
			
			echo '<div class="widget eltdf-button-widget">';
			echo do_shortcode( "[eltdf_button $params]" ); // XSS OK
			echo '</div>';
		}
	}
}