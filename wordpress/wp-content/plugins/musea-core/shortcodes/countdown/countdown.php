<?php
namespace MuseaCore\CPT\Shortcodes\Countdown;

use MuseaCore\Lib;

class Countdown implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_countdown';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Countdown', 'musea-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by MUSEA', 'musea-core' ),
					'icon'                      => 'icon-wpb-countdown extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'musea-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'musea-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'skin',
							'heading'    => esc_html__( 'Skin', 'musea-core' ),
							'value'      => array(
								esc_html__( 'Default', 'musea-core' ) => '',
								esc_html__( 'Light', 'musea-core' )   => 'eltdf-light-skin',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'year',
							'heading'     => esc_html__( 'Year', 'musea-core' ),
							'value'       => array(
								'2022' => '2022',
								'2023' => '2023',
								'2024' => '2024',
								'2025' => '2025',
								'2026' => '2026',
								'2027' => '2027',
								'2028' => '2028',
								'2029' => '2029',
								'2030' => '2030'
							),
							'admin_label' => true,
                            'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'month',
							'heading'     => esc_html__( 'Month', 'musea-core' ),
							'value'       => array(
								esc_html__( 'January', 'musea-core' )   => '1',
								esc_html__( 'February', 'musea-core' )  => '2',
								esc_html__( 'March', 'musea-core' )     => '3',
								esc_html__( 'April', 'musea-core' )     => '4',
								esc_html__( 'May', 'musea-core' )       => '5',
								esc_html__( 'June', 'musea-core' )      => '6',
								esc_html__( 'July', 'musea-core' )      => '7',
								esc_html__( 'August', 'musea-core' )    => '8',
								esc_html__( 'September', 'musea-core' ) => '9',
								esc_html__( 'October', 'musea-core' )   => '10',
								esc_html__( 'November', 'musea-core' )  => '11',
								esc_html__( 'December', 'musea-core' )  => '12'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'day',
							'heading'     => esc_html__( 'Day', 'musea-core' ),
							'value'       => array(
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10' => '10',
								'11' => '11',
								'12' => '12',
								'13' => '13',
								'14' => '14',
								'15' => '15',
								'16' => '16',
								'17' => '17',
								'18' => '18',
								'19' => '19',
								'20' => '20',
								'21' => '21',
								'22' => '22',
								'23' => '23',
								'24' => '24',
								'25' => '25',
								'26' => '26',
								'27' => '27',
								'28' => '28',
								'29' => '29',
								'30' => '30',
								'31' => '31',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'hour',
							'heading'     => esc_html__( 'Hour', 'musea-core' ),
							'value'       => array(
								'0'  => '0',
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10' => '10',
								'11' => '11',
								'12' => '12',
								'13' => '13',
								'14' => '14',
								'15' => '15',
								'16' => '16',
								'17' => '17',
								'18' => '18',
								'19' => '19',
								'20' => '20',
								'21' => '21',
								'22' => '22',
								'23' => '23',
								'24' => '24'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'minute',
							'heading'     => esc_html__( 'Minute', 'musea-core' ),
							'value'       => array(
								'0'  => '0',
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10' => '10',
								'11' => '11',
								'12' => '12',
								'13' => '13',
								'14' => '14',
								'15' => '15',
								'16' => '16',
								'17' => '17',
								'18' => '18',
								'19' => '19',
								'20' => '20',
								'21' => '21',
								'22' => '22',
								'23' => '23',
								'24' => '24',
								'25' => '25',
								'26' => '26',
								'27' => '27',
								'28' => '28',
								'29' => '29',
								'30' => '30',
								'31' => '31',
								'32' => '32',
								'33' => '33',
								'34' => '34',
								'35' => '35',
								'36' => '36',
								'37' => '37',
								'38' => '38',
								'39' => '39',
								'40' => '40',
								'41' => '41',
								'42' => '42',
								'43' => '43',
								'44' => '44',
								'45' => '45',
								'46' => '46',
								'47' => '47',
								'48' => '48',
								'49' => '49',
								'50' => '50',
								'51' => '51',
								'52' => '52',
								'53' => '53',
								'54' => '54',
								'55' => '55',
								'56' => '56',
								'57' => '57',
								'58' => '58',
								'59' => '59',
								'60' => '60',
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'month_label',
							'heading'    => esc_html__( 'Month Label', 'musea-core' )
						),
                        array(
							'type'       => 'textfield',
							'param_name' => 'month_singular_label',
							'heading'    => esc_html__( 'Month Singular Label', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'day_label',
							'heading'    => esc_html__( 'Day Label', 'musea-core' )
						),
                        array(
							'type'       => 'textfield',
							'param_name' => 'day_singular_label',
							'heading'    => esc_html__( 'Day Singula Label', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'hour_label',
							'heading'    => esc_html__( 'Hour Label', 'musea-core' )
						),
                        array(
							'type'       => 'textfield',
							'param_name' => 'hour_singular_label',
							'heading'    => esc_html__( 'Hour Singular Label', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'minute_label',
							'heading'    => esc_html__( 'Minute Label', 'musea-core' )
						),
                        array(
							'type'       => 'textfield',
							'param_name' => 'minute_singular_label',
							'heading'    => esc_html__( 'Minute Singular Label', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'second_label',
							'heading'    => esc_html__( 'Second Label', 'musea-core' )
						),
                        array(
							'type'       => 'textfield',
							'param_name' => 'second_singular_label',
							'heading'    => esc_html__( 'Second Singular Label', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'digit_font_size',
							'heading'    => esc_html__( 'Digit Font Size (px)', 'musea-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'label_font_size',
							'heading'    => esc_html__( 'Label Font Size (px)', 'musea-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'    => '',
			'skin'            => '',
			'year'            => '',
			'month'           => '',
			'day'             => '',
			'hour'            => '',
			'minute'          => '',
			'month_label'     => 'Months',
			'month_singular_label' => '',
			'day_label'       => 'Days',
			'day_singular_label' => '',
			'hour_label'      => 'Hours',
			'hour_singular_label' => '',
			'minute_label'    => 'Minutes',
			'minute_singular_label' => '',
			'second_label'    => 'Seconds',
			'second_singular_label' => '',
			'digit_font_size' => '',
			'label_font_size' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['id']             = mt_rand( 1000, 9999 );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getHolderData( $params );
		
		wp_enqueue_script( 'jquery-plugin', MUSEA_CORE_SHORTCODES_URL_PATH . '/countdown/assets/js/plugins/jquery.plugin.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'countdown', MUSEA_CORE_SHORTCODES_URL_PATH . '/countdown/assets/js/plugins/jquery.countdown.min.js', array( 'jquery' ), false, true );
		
		$html = musea_core_get_shortcode_module_template_part( 'templates/countdown', 'countdown', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderData( $params ) {
		$holderData = array();
		
		$holderData['data-year']         = ! empty( $params['year'] ) ? $params['year'] : '';
		$holderData['data-month']        = ! empty( $params['month'] ) ? $params['month'] : '';
		$holderData['data-day']          = ! empty( $params['day'] ) ? $params['day'] : '';
		$holderData['data-hour']         = $params['hour'] !== '' ? $params['hour'] : '';
		$holderData['data-minute']       = $params['minute'] !== '' ? $params['minute'] : '';
		$holderData['data-month-label']  = ! empty( $params['month_label'] ) ? $params['month_label'] : esc_html__( 'Months', 'musea-core' );
		$holderData['data-month-singular-label']  = ! empty( $params['month_singular_label'] ) ? $params['month_singular_label'] : '';
		$holderData['data-day-label']    = ! empty( $params['day_label'] ) ? $params['day_label'] : esc_html__( 'Days', 'musea-core' );
		$holderData['data-day-singular-label']    = ! empty( $params['day_singular_label'] ) ? $params['day_singular_label'] : '';
		$holderData['data-hour-label']   = ! empty( $params['hour_label'] ) ? $params['hour_label'] : esc_html__( 'Hours', 'musea-core' );
		$holderData['data-hour-singular-label']   = ! empty( $params['hour_singular_label'] ) ? $params['hour_singular_label'] : '';
		$holderData['data-minute-label'] = ! empty( $params['minute_label'] ) ? $params['minute_label'] : esc_html__( 'Minutes', 'musea-core' );
		$holderData['data-minute-singular-label'] = ! empty( $params['minute_singular_label'] ) ? $params['minute_singular_label'] : '';
		$holderData['data-second-label'] = ! empty( $params['second_label'] ) ? $params['second_label'] : esc_html__( 'Seconds', 'musea-core' );
		$holderData['data-second-singular-label'] = ! empty( $params['second_singular_label'] ) ? $params['second_singular_label'] : '';
		$holderData['data-digit-size']   = ! empty( $params['digit_font_size'] ) ? $params['digit_font_size'] : '';
		$holderData['data-label-size']   = ! empty( $params['label_font_size'] ) ? $params['label_font_size'] : '';
		
		return $holderData;
	}
}