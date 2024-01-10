<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="eltdf-sl-loading">
		<div class="eltdf-sl-loading-bounce1"></div>
		<div class="eltdf-sl-loading-bounce2"></div>
		<div class="eltdf-sl-loading-bounce3"></div>
	</div>
	<div class="eltdf-sl-load-more-holder">
		<div class="eltdf-sl-load-more" <?php musea_elated_inline_style($holder_styles); ?>>
			<?php 
				echo musea_elated_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'medium',
					'type' => 'outline-slit',
					'text' => esc_html__('Load more', 'musea-shows')
				));
			?>
		</div>
	</div>
<?php }