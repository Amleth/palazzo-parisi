<?php
namespace MuseaCore\CPT\Shortcodes\ExpandedGallery;

use MuseaCore\Lib;

class ExpandedGallery implements Lib\ShortcodeInterface {
	
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_expanded_gallery';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Expanded Gallery', 'musea-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by MUSEA', 'musea-core' ),
					'icon'                      => 'icon-wpb-expanded-gallery extended-custom-icon',
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
							'param_name'  => 'number_of_images',
							'heading'     => esc_html__( 'Number of Images', 'musea-core' ),
							'value'       => array(
								esc_html__( 'Three', 'musea-core' ) => 'three',
								esc_html__( 'Five', 'musea-core' )  => 'five'
							),
							'save_always' => true
						),
						array(
							'type'        => 'attach_images',
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'musea-core' ),
							'description' => esc_html__( 'Select images from media library. Images needs to be same size', 'musea-core' )
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'custom_links',
							'heading'     => esc_html__( 'Custom Links', 'musea-core' ),
							'description' => esc_html__( 'Delimit links by comma', 'musea-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'musea-core' ),
							'value'      => array_flip( musea_elated_get_link_target_array() )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'custom_class'       => '',
			'number_of_images'   => 'five',
			'images'             => '',
			'custom_links'       => '',
			'custom_link_target' => '_self'
		);
		
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['images']         = $this->getGalleryImages( $params );
		$params['links']          = $this->getGalleryLinks( $params );
		$params['target']         = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		
		$html = musea_core_get_shortcode_module_template_part( 'templates/expanded-gallery', 'expanded-gallery', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['number_of_images'] ) ? ' eltdf-eg-' . $params['number_of_images'] : ' eltdf-eg-five';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;
		
		if ( $params['images'] !== '' ) {
			$image_ids = explode( ',', $params['images'] );
		}
		
		foreach ( $image_ids as $id ) {
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
			
			$images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
	}
	
	private function getGalleryLinks( $params ) {
		$custom_links = array();
		
		if ( ! empty( $params['custom_links'] ) ) {
			$custom_links = array_map( 'trim', explode( ',', $params['custom_links'] ) );
		}
		
		return $custom_links;
	}
}