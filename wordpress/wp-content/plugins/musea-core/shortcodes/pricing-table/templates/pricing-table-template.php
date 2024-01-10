<div class="eltdf-price-table eltdf-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-pt-inner" <?php echo musea_elated_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="eltdf-pt-title-holder">
				<h5 class="eltdf-pt-title" <?php echo musea_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></h5>
			</li>
            <li class="eltdf-pt-content">
                <?php echo do_shortcode($content); ?>
            </li>
			<li class="eltdf-pt-prices">
				<span class="eltdf-pt-value" <?php echo musea_elated_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
				<span class="eltdf-pt-price" <?php echo musea_elated_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
			</li>
            <li class="eltdf-pt-mark">
                <?php if( !empty($price_period)) { ?>
                    <span class="eltdf-pt-mark-value" <?php echo musea_elated_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></span>
                <?php } ?>
            </li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="eltdf-pt-button">
					<?php echo musea_elated_get_button_html(array(
						'link' => $link,
						'target' => $target,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'medium'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>