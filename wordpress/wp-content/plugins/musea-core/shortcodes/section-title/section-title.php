<?php
namespace MuseaCore\CPT\Shortcodes\SectionTitle;

use MuseaCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_section_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Section Title', 'musea-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by MUSEA', 'musea-core' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'musea-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'musea-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'musea-core' ),
							'value'       => array(
								esc_html__( 'Default', 'musea-core' ) => '',
								esc_html__( 'Left', 'musea-core' )    => 'left',
								esc_html__( 'Center', 'musea-core' )  => 'center',
								esc_html__( 'Right', 'musea-core' )   => 'right'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'musea-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'caption',
							'heading'     => esc_html__( 'Caption', 'musea-core' ),
							'admin_label' => true
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'caption_color',
                            'heading'    => esc_html__( 'Caption Color', 'musea-core' ),
                            'dependency' => array( 'element' => 'caption', 'not_empty' => true ),
                            'group'       => esc_html__( 'Caption Style', 'musea-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'caption_margin',
                            'heading'     => esc_html__( 'Caption margin', 'musea-core' ),
                            'description' => esc_html__( 'Enter CSS margin e.g. (10px 2% 15px)', 'musea-core' ),
                            'dependency' => array( 'element' => 'caption', 'not_empty' => true ),
                            'group'       => esc_html__( 'Caption Style', 'musea-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'caption_tag',
                            'heading'     => esc_html__( 'Caption Tag', 'musea-core' ),
                            'value'       => array_flip( musea_elated_get_title_tag( false, array( 'p' => 'p', 'span' => 'span' ) ) ),
                            'dependency'  => array( 'element' => 'caption', 'not_empty' => true ),
                            'group'       => esc_html__( 'Caption Style', 'musea-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'caption_font_size',
                            'heading'    => esc_html__( 'Caption Font Size (px)', 'musea-core' ),
                            'dependency' => array( 'element' => 'caption', 'not_empty' => true ),
                            'group'      => esc_html__( 'Caption Style', 'musea-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title',
                            'heading'     => esc_html__( 'Title', 'musea-core' ),
                            'admin_label' => true
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'musea-core' ),
							'value'       => array_flip( musea_elated_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'musea-core' )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'title_font_size',
                            'heading'    => esc_html__( 'Title Font Size (px)', 'musea-core' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                            'group'      => esc_html__( 'Title Style', 'musea-core' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'decorative_line',
                            'heading'    => esc_html__( 'Enable decorative lines', 'musea-core' ),
                            'value'      => array_flip( musea_elated_get_yes_no_select_array( false, true ) ),
                            'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
                            'description' => esc_html__( 'This will enable decorative lines aside title', 'musea-core' ),
                            'group'       => esc_html__( 'Title Style', 'musea-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'decorative_line_color',
                            'heading'    => esc_html__( 'Decorative Line Color', 'musea-core' ),
                            'dependency' => array( 'element' => 'decorative_line', 'value' => 'yes' ),
                            'group'      => esc_html__( 'Title Style', 'musea-core' )
                        ),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'musea-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'musea-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'musea-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'musea-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'musea-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'musea-core' ),
							'value'       => array_flip( musea_elated_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'musea-core' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'musea-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'musea-core' ),
							'value'       => array_flip( musea_elated_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'musea-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'musea-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_font_size',
							'heading'    => esc_html__( 'Text Font Size (px)', 'musea-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_line_height',
							'heading'    => esc_html__( 'Text Line Height (px)', 'musea-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'musea-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_font_weight',
							'heading'     => esc_html__( 'Text Font Weight', 'musea-core' ),
							'value'       => array_flip( musea_elated_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_margin',
							'heading'    => esc_html__( 'Text  Margin', 'musea-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'musea-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Button Link', 'musea-core' ),
							'group'      => esc_html__( 'Button Style', 'musea-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_target',
							'heading'    => esc_html__( 'Button Link Target', 'musea-core' ),
							'value'      => array_flip( musea_elated_get_link_target_array() ),
							'group'      => esc_html__( 'Button Style', 'musea-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_color',
							'heading'    => esc_html__( 'Button Color', 'musea-core' ),
							'group'      => esc_html__( 'Button Style', 'musea-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_color',
							'heading'    => esc_html__( 'Button Hover Color', 'musea-core' ),
							'group'      => esc_html__( 'Button Style', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_top_margin',
							'heading'    => esc_html__( 'Button Top Margin (px)', 'musea-core' ),
							'group'      => esc_html__( 'Button Style', 'musea-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'position'            => '',
			'holder_padding'      => '',
			'caption'             => '',
			'caption_color'       => '',
			'caption_margin'      => '',
			'caption_tag'         => 'span',
			'caption_font_size'   => '',
			'title'               => '',
			'title_tag'           => 'h2',
			'title_font_size'     => '',
			'decorative_line'     => 'yes',
			'decorative_line_color'  => '',
			'title_color'         => '',
			'title_break_words'   => '',
			'disable_break_words' => '',
			'text'                => '',
			'text_tag'            => 'p',
			'text_color'          => '',
			'text_font_size'      => '',
			'text_line_height'    => '',
			'text_font_weight'    => '',
			'text_margin'         => '',
			'button_text'         => '',
			'button_link'         => '',
			'button_target'       => '_self',
			'button_color'        => '',
			'button_hover_color'  => '',
			'button_top_margin'   => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']    = $this->getHolderClasses( $params, $args );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['title']             = $this->getModifiedTitle( $params );
		$params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']      = $this->getTitleStyles( $params );
		$params['text_tag']          = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		$params['text_styles']       = $this->getTextStyles( $params );
		$params['button_parameters'] = $this->getButtonParameters( $params );
		$params['caption_styles']    = $this->getCaptionStyles( $params );
		$params['decorative_line_styles']    = $this->getDecorativeLineStyles( $params );

		$html = musea_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'eltdf-st-disable-title-break' : '';
		$holderClasses[] = $params['decorative_line'] === 'yes' ? 'eltdf-st-decorative-line' : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );
		
		if ( ! empty( $title ) ) {
			$split_title = explode( ' ', $title );
			
			if ( ! empty( $title_break_words ) ) {
				$title_break_words = intval($title_break_words);

				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<span class="qodef-st-line-breaker"></span>';
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

        if ( ! empty( $params['title_font_size'] ) ) {
            $styles[] = 'font-size: ' .  musea_elated_filter_px( $params['title_font_size'] ) . 'px';
        }
		
		return implode( ';', $styles );
	}

    private function getCaptionStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['caption_color'] ) ) {
            $styles[] = 'color: ' . $params['caption_color'];
        }

        if ( ! empty( $params['caption_margin'] ) ) {
            $styles[] = 'margin: ' . $params['caption_margin'];
        }

        if ( ! empty( $params['caption_font_size'] ) ) {
            $styles[] = 'font-size: ' . musea_elated_filter_px( $params['caption_font_size'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getDecorativeLineStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['decorative_line_color'] ) ) {
            $styles[] = 'background-color: ' . $params['decorative_line_color'];
            $styles[] = 'opacity: 1';
        }

        return implode( ';', $styles );
    }
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . musea_elated_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . musea_elated_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['text_margin'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getButtonParameters( $params ) {
		$button_params = array();
		
		if ( ! empty( $params['button_text'] ) ) {
			$button_params['text'] = $params['button_text'];
			$button_params['type'] = 'outline-slit';
			$button_params['link'] = ! empty( $params['button_link'] ) ? $params['button_link'] : '#';
			$button_params['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';
			
			if ( ! empty( $params['button_color'] ) ) {
				$button_params['color'] = $params['button_color'];
			}
			
			if ( ! empty( $params['button_hover_color'] ) ) {
				$button_params['hover_color'] = $params['button_hover_color'];
			}
			
			if ( $params['button_top_margin'] !== '' ) {
				$button_params['margin'] = intval( $params['button_top_margin'] ) . 'px 0 0';
			}
		}
		
		return $button_params;
	}
}
