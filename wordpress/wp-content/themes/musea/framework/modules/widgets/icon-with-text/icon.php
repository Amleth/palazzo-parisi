<?php

if ( class_exists( 'MuseaCoreClassWidget' ) ) {
	class MuseaElatedClassIconWithTextWidget extends MuseaCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'eltdf_icon_with_text_widget',
				esc_html__( 'Musea Icon With Text Widget', 'musea' ),
				array( 'description' => esc_html__( 'Add icons with text to widget areas', 'musea' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array_merge(
				musea_elated_icon_collections()->getIconWidgetParamsArray(),
				array(
                    array(
                        'type'  => 'textfield',
                        'name'  => 'title',
                        'title' => esc_html__( 'Icon Title', 'musea' )
                    ),
					array(
						'type'  => 'textarea',
						'name'  => 'icon_text',
						'title' => esc_html__( 'Icon Text', 'musea' )
					),
					array(
						'type'  => 'textfield',
						'name'  => 'link',
						'title' => esc_html__( 'Link', 'musea' )
					),
					array(
						'type'    => 'dropdown',
						'name'    => 'target',
						'title'   => esc_html__( 'Target', 'musea' ),
						'options' => musea_elated_get_link_target_array()
					),
					array(
						'type'  => 'textfield',
						'name'  => 'icon_size',
						'title' => esc_html__( 'Icon Size (px)', 'musea' )
					),
					array(
						'type'  => 'colorpicker',
						'name'  => 'icon_color',
						'title' => esc_html__( 'Icon Color', 'musea' )
					),
					array(
						'type'  => 'colorpicker',
						'name'  => 'icon_hover_color',
						'title' => esc_html__( 'Icon Hover Color', 'musea' )
					),
					array(
						'type'  => 'textfield',
						'name'  => 'text_size',
						'title' => esc_html__( 'Text Size (px)', 'musea' )
					),
					array(
						'type'  => 'colorpicker',
						'name'  => 'text_color',
						'title' => esc_html__( 'Text Color', 'musea' )
					)
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$holder_classes = array( 'eltdf-icon-widget-holder' );
			if ( ! empty( $instance['icon_hover_color'] ) ) {
				$holder_classes[] = 'eltdf-icon-has-hover';
			}
			
			$data   = array();
			$data[] = ! empty( $instance['icon_hover_color'] ) ? musea_elated_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ) : '';
			$data   = implode( ' ', $data );
			
			$holder_styles = array();
			if ( isset( $instance['margin'] ) && $instance['margin'] !== '' ) {
				$holder_styles[] = 'margin: ' . $instance['margin'];
			}
			
			$icon_styles = array();
			if ( ! empty( $instance['icon_color'] ) ) {
				$icon_styles[] = 'color: ' . $instance['icon_color'];
			}
			if ( ! empty( $instance['icon_size'] ) ) {
				$icon_styles[] = 'font-size: ' . musea_elated_filter_px( $instance['icon_size'] ) . 'px';
			}

//			if ( ! empty( $instance['text_color'] ) ) {
//				$text_styles[] = 'color: ' . $instance['text_color'];
//			}
			
			$link   = ! empty( $instance['link'] ) ? $instance['link'] : '#';
			$target = ! empty( $instance['target'] ) ? $instance['target'] : '_self';
			
			$icon_holder_html = '';

			if ( ! empty( $instance['icon_pack'] ) ) {
				$icon_class   = array();
				$icon_class[] = ! empty( $instance['fa_icon'] ) && $instance['icon_pack'] === 'font_awesome' ? $instance['fa_icon'] : '';
				$icon_class[] = ! empty( $instance['fe_icon'] ) && $instance['icon_pack'] === 'font_elegant' ? $instance['fe_icon'] : '';
				$icon_class[] = ! empty( $instance['ion_icon'] ) && $instance['icon_pack'] === 'ion_icons' ? $instance['ion_icon'] : '';
				$icon_class[] = ! empty( $instance['linea_icon'] ) && $instance['icon_pack'] === 'linea_icons' ? $instance['linea_icon'] : '';
				$icon_class[] = ! empty( $instance['linear_icon'] ) && $instance['icon_pack'] === 'linear_icons' ? 'lnr ' . $instance['linear_icon'] : '';
				$icon_class[] = ! empty( $instance['simple_line_icon'] ) && $instance['icon_pack'] === 'simple_line_icons' ? $instance['simple_line_icon'] : '';
				$icon_class[] = ! empty( $instance['dripicon'] ) && $instance['icon_pack'] === 'dripicons' ? $instance['dripicon'] : '';

				$icon_class = array_filter( $icon_class, function ( $value ) {
					return $value !== '';
				} );

				if ( ! empty( $icon_class ) ) {
					$icon_class = implode( ' ', $icon_class );
					
					$icon_holder_html = '<span class="eltdf-icon-element ' . esc_attr( $icon_class ) . '" ' . musea_elated_get_inline_style( $icon_styles ) . '></span>';
				}
			}
            $iconParameters['icon_attributes']['class'] = $icon_class;

            echo do_shortcode( '[eltdf_icon_with_text 
            type="icon-left"
            icon_pack="'.$instance['icon_pack'].'"
            icon_hidden="'.$icon_class.'" 
            title_tag="h6" 
            custom_icon_size="'.$instance['icon_size'].'" 
            icon_color="'.$instance['icon_color'].'" 
            icon_hover_color="'.$instance['icon_hover_color'].'" 
            title="'.$instance['title'].'" 
            title_color="#4e4e4e" 
            text="'.$instance['icon_text'].'" 
            text_color="'.$instance['text_color'].'" 
            link="'.$link.'" 
            target="'.$target.'" 
            title_top_margin="6px" 
            text_top_margin="13px"]' );

		}
	}
}