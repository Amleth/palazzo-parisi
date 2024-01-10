<?php

if ( ! function_exists( 'musea_core_action_like' ) ) {
	/**
	 * Returns MuseaElatedClassLike instance
	 *
	 * @return MuseaElatedClassLike
	 */
	function musea_core_action_like() {
		return MuseaElatedClassLike::get_instance();
	}
}

function musea_core_get_like() {
	
	echo wp_kses( musea_core_action_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}