<?php

namespace MuseaElatedNamespace\Modules\Header\Lib;

/**
 * Class MuseaElatedClassHeaderConnector
 *
 * Connects header module with other modules
 */
class MuseaElatedClassHeaderConnector {
	/**
	 * @param HeaderType $object
	 */
	public function __construct( HeaderType $object ) {
		$this->object = $object;
	}
	
	/**
	 * Connects given object with other modules based on pased config
	 *
	 * @param array $config
	 */
	public function connect( $config = array() ) {
		do_action( 'musea_elated_action_pre_header_connect' );
		
		$defaultConfig = array(
			'affect_content' => true,
			'affect_title'   => true,
			'affect_slider'  => true
		);
		
		if ( is_array( $config ) && count( $config ) ) {
			$config = array_merge( $defaultConfig, $config );
		}
		
		if ( ! empty( $config['affect_content'] ) ) {
			add_filter( 'musea_elated_filter_content_elem_style_attr', array( $this, 'contentMarginFilter' ) );
		}
		
		if ( ! empty( $config['affect_title'] ) ) {
			add_filter( 'musea_elated_filter_title_content_padding', array( $this, 'titlePaddingFilter' ) );
		}
		
		do_action( 'musea_elated_action_after_header_connect' );
	}
	
	/**
	 * Adds margin-top property to content element based on height of transparent parts of header
	 *
	 * @param $styles
	 *
	 * @return array
	 */
	public function contentMarginFilter( $styles ) {
		$marginTopValue = $this->object->getHeightOfTransparency();

        //This is because of the header padding of 10px only when content needs to be below header
        $chosen_header_type = musea_elated_get_meta_field_intersect('header_type', get_the_ID());

        $marginTopValue = $marginTopValue !== 0 && $chosen_header_type == 'header-standard' || $chosen_header_type == 'header-minimal' ? $marginTopValue + 24 : $marginTopValue;
		
		if ( ! empty( $marginTopValue ) ) {
			$styles[] = 'margin-top: -' . $marginTopValue  . 'px';
		}
		
		return $styles;
	}
	
	/**
	 * Returns padding value calculated from transparent header parts.
	 *
	 * Hooks to musea_elated_filter_title_content_padding filter
	 *
	 * @return int
	 */
	public function titlePaddingFilter() {
		$heightOfTransparency = $this->object->getHeightOfTransparency();
		
		return ! empty( $heightOfTransparency ) ? $heightOfTransparency : 0;
	}
}