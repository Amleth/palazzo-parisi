<?php

if ( class_exists( 'MuseaCoreClassWidget' ) ) {
	class MuseaElatedClassSeparatorWidget extends MuseaCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'eltdf_separator_widget',
				esc_html__( 'Musea Separator Widget', 'musea' ),
				array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'musea' ) )
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
						'normal'     => esc_html__( 'Normal', 'musea' ),
						'full-width' => esc_html__( 'Full Width', 'musea' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'position',
					'title'   => esc_html__( 'Position', 'musea' ),
					'options' => array(
						'center' => esc_html__( 'Center', 'musea' ),
						'left'   => esc_html__( 'Left', 'musea' ),
						'right'  => esc_html__( 'Right', 'musea' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'border_style',
					'title'   => esc_html__( 'Style', 'musea' ),
					'options' => array(
						'solid'  => esc_html__( 'Solid', 'musea' ),
						'dashed' => esc_html__( 'Dashed', 'musea' ),
						'dotted' => esc_html__( 'Dotted', 'musea' )
					)
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'musea' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'width',
					'title' => esc_html__( 'Width (px or %)', 'musea' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'thickness',
					'title' => esc_html__( 'Thickness (px)', 'musea' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'top_margin',
					'title' => esc_html__( 'Top Margin (px or %)', 'musea' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'bottom_margin',
					'title' => esc_html__( 'Bottom Margin (px or %)', 'musea' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			//prepare variables
			$params = '';
			
			//is instance empty?
			if ( is_array( $instance ) && count( $instance ) ) {
				//generate shortcode params
				foreach ( $instance as $key => $value ) {
					$params .= " $key='$value' ";
				}
			}
			
			echo '<div class="widget eltdf-separator-widget">';
			echo do_shortcode( "[eltdf_separator $params]" ); // XSS OK
			echo '</div>';
		}
	}
}