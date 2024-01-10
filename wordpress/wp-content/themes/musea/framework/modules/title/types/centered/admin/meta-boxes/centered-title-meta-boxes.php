<?php

if ( ! function_exists( 'musea_elated_centered_title_type_options_meta_boxes' ) ) {
	function musea_elated_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'musea' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'musea' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_additional_title_area_meta_boxes', 'musea_elated_centered_title_type_options_meta_boxes', 5 );
}