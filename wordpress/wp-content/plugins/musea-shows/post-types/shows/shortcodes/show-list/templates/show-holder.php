<div class="eltdf-show-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<div class="eltdf-sl-inner eltdf-outer-space <?php echo esc_attr($inner_classes); ?>" <?php echo musea_elated_get_inline_attrs($data_attrs); ?>>
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					$single_params = array();
					$single_params['title_tag'] = $title_tag;
					$single_params['show_single_layout'] = $show_single_layout;
					$single_params['show_id'] = get_the_ID();
					$single_params['article_classes'] = $this_object->getArticleClasses( $params );
					$single_params['show_category'] = $show_category;
					$single_params['show_date_range'] = $show_date_range;
					$single_params['image_proportions'] = $image_proportions;

					echo musea_elated_execute_shortcode('eltdf_show_single', $single_params);
				endwhile;
			else:
				esc_html_e( 'Sorry, no posts matched your criteria.', 'musea-shows' );
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	<?php echo musea_shows_get_cpt_shortcode_module_template_part('shows', 'show-list', 'pagination/'.$pagination_type, '', $params, $additional_params); ?>
</div>