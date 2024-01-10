<?php

/*** Post Settings ***/

if ( ! function_exists( 'musea_elated_map_post_meta' ) ) {
	function musea_elated_map_post_meta() {
		
		$post_meta_box = musea_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'musea' ),
				'name'  => 'post-meta'
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'musea' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'musea' ),
				'parent'        => $post_meta_box,
				'options'       => musea_elated_get_yes_no_select_array()
			)
		);
		
		musea_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'musea' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'musea' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => musea_elated_get_custom_sidebars_options( true )
			)
		);
		
		$musea_custom_sidebars = musea_elated_get_custom_sidebars();
		if ( count( $musea_custom_sidebars ) > 0 ) {
			musea_elated_create_meta_box_field( array(
				'name'        => 'eltdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'musea' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'musea' ),
				'parent'      => $post_meta_box,
				'options'     => musea_elated_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		musea_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'musea' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'musea' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('musea_elated_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_post_meta', 20 );
}
