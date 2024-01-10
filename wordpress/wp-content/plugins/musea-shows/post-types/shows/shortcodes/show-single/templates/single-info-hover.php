<?php
$image_meta          = get_post_meta( $show_id, 'eltdf_show_list_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail( $show_id );
$show_list_image_id  = ! empty( $image_meta ) ? musea_elated_get_attachment_id_from_url( $image_meta ) : '';
?>

<div class="eltdf-show eltdf-item-space <?php echo esc_attr($article_classes) ?>">
	<div class="eltdf-show-inner">
		<?php if ( $has_featured ) { ?>
			<div class="eltdf-show-image">
				<a itemprop="url" href="<?php echo esc_url(get_the_permalink($show_id)) ?>">
					<?php if ( ! empty( $show_list_image_id ) ) {
						echo wp_get_attachment_image( $show_list_image_id, 'full' );
					} else { ?>
						<?php echo get_the_post_thumbnail($show_id, 'full'); ?>
					<?php } ?>
				</a>
			</div>
		<?php } ?>
		<div class="eltdf-show-info">
			<div class="eltdf-show-outter">
				<div class="eltdf-show-info-inner">
					<div class="eltdf-show-title-holder">
						<div class="eltdf-show-title-wrapper">
							<<?php echo esc_attr($title_tag); ?> itemprop="name" class="eltdf-show-name entry-title">
								<a itemprop="url" href="<?php echo esc_url(get_the_permalink($show_id)) ?>"><?php echo esc_html($title) ?></a>
							</<?php echo esc_attr($title_tag);?>>
							<?php if(!empty($category)) { ?>
								<div class="eltdf-show-categories-holder">
									<?php foreach ($category as $cat) { ?>
										<a itemprop="url" class="eltdf-show-categories" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<a class="eltdf-show-link" itemprop="url" href="<?php echo esc_url(get_the_permalink($show_id)) ?>"></a>
				</div>
			</div>
		</div>
	</div>
</div>