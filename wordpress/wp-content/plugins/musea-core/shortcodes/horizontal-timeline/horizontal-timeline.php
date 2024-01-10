<?php
namespace MuseaCore\CPT\Shortcodes\HorizontalTimeline;

use MuseaCore\Lib;

class HorizontalTimeline implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_horizontal_timeline';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Horizontal Timeline', 'musea-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by MUSEA', 'musea-core' ),
					'icon'                    => 'icon-wpb-horizontal-timeline extended-custom-icon',
					'as_parent'               => array( 'only' => 'eltdf_horizontal_timeline_item' ),
					'js_view'                 => 'VcColumnView',
					'content_element'         => true,
					'show_settings_on_create' => false,
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'timeline_format',
							'heading'     => esc_html__( 'Timeline displays?', 'musea-core' ),
							'value'       => array(
								esc_html__( 'Only Years', 'musea-core' )             => 'Y',
								esc_html__( 'Years and Months', 'musea-core' )       => 'M Y',
								esc_html__( 'Years, Months and Days', 'musea-core' ) => 'M d, \'y',
								esc_html__( 'Months and Days', 'musea-core' )        => 'M d'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'distance',
							'heading'     => esc_html__( 'Minimal Distance Between Dates?', 'musea-core' ),
							'description' => esc_html__( 'Default value is 60', 'musea-core' ),
							'admin_label' => true
						)
					)
				)
			);
		}
	}
	
	/**
	 * Renders HTML for product list shortcode
	 *
	 * @param array $atts
	 * @param null  $content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {
		$args   = array(
			'timeline_format' => 'Y',
			'distance'        => '60'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']         = $content;
		$params['timeline_format'] = ! empty( $params['timeline_format'] ) ? $params['timeline_format'] : $args['timeline_format'];
		$params['dates']           = $this->getDates( $content, $params['timeline_format'] );
		
		$html = musea_core_get_shortcode_module_template_part( 'templates/horizontal-timeline-holder', 'horizontal-timeline', '', $params );
		
		return $html;
	}
	
	private function getDates( $content, $timeline_format ) {
		$datesArray = array();
		
		preg_match_all( '/date="(.*?)"/i', $content, $matches );
	
		if ( isset( $matches[1] ) && is_array( $matches[1] ) ) {
			foreach ( $matches[1] as $match ) {
				if ( ! empty( $match ) ) {
					$date      = new \DateTime( str_replace( '/', '-', $match ) );
					$date_info = getdate( $date->getTimestamp() );

					switch ( $date_info['month'] ) {
						case 'January':
							$month = esc_attr__( 'Jan', 'musea-core' );
							break;
						case 'February':
							$month = esc_attr__( 'Feb', 'musea-core' );
							break;
						case 'March':
							$month = esc_attr__( 'Mar', 'musea-core' );
							break;
						case 'April':
							$month = esc_attr__( 'Apr', 'musea-core' );
							break;
						case 'May':
							$month = esc_attr__( 'May', 'musea-core' );
							break;
						case 'June':
							$month = esc_attr__( 'Jun', 'musea-core' );
							break;
						case 'July':
							$month = esc_attr__( 'Jul', 'musea-core' );
							break;
						case 'August':
							$month = esc_attr__( 'Aug', 'musea-core' );
							break;
						case 'September':
							$month = esc_attr__( 'Sep', 'musea-core' );
							break;
						case 'October':
							$month = esc_attr__( 'Oct', 'musea-core' );
							break;
						case 'November':
							$month = esc_attr__( 'Nov', 'musea-core' );
							break;
						case 'December':
							$month = esc_attr__( 'Dec', 'musea-core' );
							break;
						default:
							$month = $date_info['month'];
							break;
					}
					
					switch ( $timeline_format ) {
						case 'Y':
							$date_label = $date_info['year'];
							break;
						case 'M Y':
							$date_label = $month . ' ' . $date_info['year'];
							break;
						case 'M d, \'y':
							$date_label = $month . ' ' . $date_info['mday'] . ', ' . $date_info['year'];
							break;
						case 'M d':
							$date_label = $month . ' ' . $date_info['mday'];
							break;
						default:
							$date_label = $date_info['year'];
							break;
					}
					
					$currentDate = array(
						'formatted'  => $match,
						'date_label' => $date_label
					);
					
					$datesArray[] = $currentDate;
				}
			}
		}
	
		return $datesArray;
	}
}