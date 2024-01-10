<article class="eltdf-fsg-item">
	<div class="eltdf-fsg-item-inner">
		<div class="eltdf-fsg-item-table">
			<div class="eltdf-fsg-item-table-cell">
				<div class="eltdf-fsg-item-table-cell-content">
					<?php echo musea_shows_get_cpt_shortcode_module_template_part('shows', 'fullscreen-show-grid', 'parts/title', '', $params); ?>
					<div class="eltdf-categories-holder">
						<div class="eltdf-categories-icon-holder">
							<i class="eltdf-icon-ion-icon ion-ios-arrow-right eltdf-icon-element" style=""></i>
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px"
							  	viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">
								<circle fill="none" stroke-miterlimit="10" cx="9.531" cy="9.469" r="9.031"/>
							</svg>
						</div>
						<div class="eltdf-sli-about-holder">
							<a itemprop="url" class="eltdf-sli-about" href=""><?php _e('About', 'musea-shows') ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<a itemprop="url" class="eltdf-fsgi-link eltdf-block-drag-link" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"></a>
	</div>
</article>