<?php

if ( ! function_exists( 'musea_core_map_portfolio_meta' ) ) {
	function musea_core_map_portfolio_meta() {
		global $musea_elated_global_Framework;
		
		$musea_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$musea_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$musea_portfolio_images = new MuseaElatedClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'musea-core' ), '', '', 'portfolio_images' );
		$musea_elated_global_Framework->eltdMetaBoxes->addMetaBox( 'portfolio_images', $musea_portfolio_images );
		
		$musea_portfolio_image_gallery = new MuseaElatedClassMultipleImages( 'eltdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'musea-core' ), esc_html__( 'Choose your portfolio images', 'musea-core' ) );
		$musea_portfolio_images->addChild( 'eltdf-portfolio-image-gallery', $musea_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$musea_portfolio_images_videos = musea_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'musea-core' ),
				'name'  => 'eltdf_portfolio_images_videos'
			)
		);
		musea_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_single_upload',
				'parent'      => $musea_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'musea-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'musea-core' ),
						'options' => array(
							'image' => esc_html__('Image','musea-core'),
							'video' => esc_html__('Video','musea-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'musea-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'musea-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'musea-core'),
							'vimeo' => esc_html__('Vimeo', 'musea-core'),
							'self' => esc_html__('Self Hosted', 'musea-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'musea-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'musea-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'musea-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$musea_additional_sidebar_items = musea_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'musea-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		musea_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_properties',
				'parent'      => $musea_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'musea-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'musea-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'musea-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'musea-core' )
					)
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_meta_boxes_map', 'musea_core_map_portfolio_meta', 40 );
}