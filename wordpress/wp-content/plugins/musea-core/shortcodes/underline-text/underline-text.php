<?php
namespace MuseaCore\CPT\Shortcodes\UnderlineText;

use MuseaCore\Lib;

class UnderlineText implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_underline_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Underline Text', 'musea-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by MUSEA', 'musea-core' ),
					'icon'                      => 'icon-wpb-underline-text extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'musea-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'musea-core' )
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'text',
							'heading'     => esc_html__( 'Text', 'musea-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'musea-core' ),
							'value'       => array_flip( musea_elated_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'musea-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'underline_words',
							'heading'     => esc_html__( 'Underline Words', 'musea-core' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display as underline. Separate the positions with commas (e.g. if you would like the first, second, and third word to have a underline, you would enter "1,2,3")', 'musea-core' ),
							'dependency'  => array( 'element' => 'text', 'not_empty' => true )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'    => '',
			'text'            => '',
			'text_tag'        => 'h5',
			'text_color'      => '',
			'underline_words' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		$params['text']           = $this->getModifiedTitle( $params );
		$params['text_tag']       = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		
		$html = musea_core_get_shortcode_module_template_part( 'templates/underline-text', 'underline-text', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$text = $params['text'];
		
		if ( ! empty( $text ) ) {
			$underline_words = array_filter( explode( ',', str_replace( ' ', '', $params['underline_words'] ) ) );
			array_walk( $underline_words, 'intval' );
			
			if ( ! empty( $underline_words ) ) {
				$split_text = explode( ' ', $text );
				$link_begin = '<span class="eltdf-ut-underline">';
				$link_end   = '</span>';
				$prev_value = - 1;
				
				foreach ( $underline_words as $value ) {
					$value = intval($value);

					if ( ! empty( $split_text[ $value - 1 ] ) ) {
						$link_begin_html = $prev_value + 1 !== $value ? $link_begin : '';
						$link_end_html   = ! in_array( $value + 1, $underline_words ) ? $link_end : '';
						$prev_value      = $value;
						
						$split_text[ $value - 1 ] = $link_begin_html . $split_text[ $value - 1 ] . $link_end_html;
					}
				}
				
				$text = implode( ' ', $split_text );
			}
		}
		
		return $text;
	}
}
