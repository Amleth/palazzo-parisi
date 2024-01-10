<div class="eltdf-fullscreen-show-grid-holder <?php echo esc_attr($holder_classes); ?>" <?php echo esc_attr($holder_data);?>>
	<div class="eltdf-fsg-holder-inner">
		<?php
			if($query_results->have_posts()):
				$image_html = '';
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo musea_shows_get_cpt_shortcode_module_template_part('shows', 'fullscreen-show-grid', 'show-item-grid', '', $params);
					$image_html .= musea_shows_get_cpt_shortcode_module_template_part('shows', 'fullscreen-show-grid', 'parts/image-url', '', $params);
				endwhile;
			else:
				echo musea_shows_get_cpt_shortcode_module_template_part('shows', 'fullscreen-show-grid', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	<div class="eltdf-fsg-image-holder">
		<?php echo ($image_html); ?>
	</div>
</div>