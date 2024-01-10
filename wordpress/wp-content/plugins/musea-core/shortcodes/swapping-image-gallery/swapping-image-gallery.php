<?php
namespace MuseaCore\CPT\Shortcodes\SwappingImageGallery;

use MuseaCore\Lib;

class SwappingImageGallery implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_swapping_image_gallery';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Swapping Image Gallery', 'musea-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by MUSEA', 'musea-core' ),
					'icon'     => 'icon-wpb-swapping-image-gallery extended-custom-icon',
					'params'   => array(
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'musea-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_highlight_words',
							'heading'     => esc_html__( 'Highlight Words', 'musea-core' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display in a most dominant color of your theme. Separate the positions with commas (e.g. if you would like the first, second, and third word to have a desired color, you would enter "1,2,3")', 'musea-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'musea-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'musea-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'description',
							'heading'    => esc_html__( 'Description', 'musea-core' )
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'image_items',
							'heading'    => esc_html__( 'Image Items', 'musea-core' ),
							'params'     => array(
								array(
									'type'        => 'attach_image',
									'param_name'  => 'gallery_image',
									'heading'     => esc_html__( 'Main Image', 'musea-core' ),
									'description' => esc_html__( 'Select image from media library', 'musea-core' )
								),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'gallery_image_link',
                                    'heading'    => esc_html__( 'Main Image Link', 'musea-core' ),
                                ),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'thumbnail',
									'heading'     => esc_html__( 'Thumbnail', 'musea-core' ),
									'description' => esc_html__( 'Select image from media library', 'musea-core' )
								)
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'title'				    => '',
			'title_highlight_words' => '',
			'title_break_words'     => '',
			'description'		    => '',
			'image_items'           => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['slider_data']	= $this->getSliderData( $params );
		$params['image_items']  = json_decode( urldecode( $params['image_items'] ), true );
		$params['title']        = $this->getModifiedTitle( $params );
		
		$html = musea_core_get_shortcode_module_template_part( 'templates/swapping-image-gallery', 'swapping-image-gallery', '', $params );
		
		return $html;
	}

	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_highlight_words  = str_replace( ' ', '', $params['title_highlight_words'] );
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );

		if ( ! empty( $title ) ) {
			$highlight_words  = explode( ',', $title_highlight_words );
			$split_title = explode( ' ', $title );

			if ( ! empty( $title_highlight_words ) ) {
				foreach ( $highlight_words as $value ) {
					$value = intval($value);

					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="eltdf-st-title-highlight">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}

			if ( ! empty( $title_break_words ) ) {
				$title_break_words = intval($title_break_words);
				
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
				}
			}

			$title = implode( ' ', $split_title );
		}

		return $title;
	}

	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-slider-animate-in'] 	= 'fadeIn';
		
		return $slider_data;
	}
}
