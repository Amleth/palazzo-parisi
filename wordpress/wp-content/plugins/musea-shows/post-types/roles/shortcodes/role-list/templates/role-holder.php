<div class="eltdf-role-list-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-rl-inner eltdf-outer-space <?php echo esc_attr($inner_classes); ?>" <?php echo musea_elated_get_inline_attrs($data_attrs); ?>>
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					$params['member_id'] = get_the_ID();
					echo musea_elated_execute_shortcode('eltdf_role_member', $params);
				endwhile;
			else:
				esc_html_e( 'Sorry, no posts matched your criteria.', 'musea-shows' );
			endif;
		
			wp_reset_postdata();
		?>
	</div>
</div>