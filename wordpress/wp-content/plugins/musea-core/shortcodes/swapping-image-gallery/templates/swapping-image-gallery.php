<div class="eltdf-sig-holder clearfix">

	<?php if ( ! empty( $image_items ) ) { ?>
		<div class="eltdf-sig-image-holder" <?php echo musea_elated_get_inline_attrs($slider_data); ?>>
			<?php foreach ( $image_items as $image_item ): ?>
                <?php if (!empty($image_item['gallery_image_link'])) { ?>
                    <a itemprop="url" href="<?php echo esc_url($image_item['gallery_image_link']); ?>" target="_blank">
                <?php } ?>
				<?php echo wp_get_attachment_image($image_item['gallery_image'], 'full'); ?>
                <?php if (!empty($image_item['gallery_image_link'])) { ?>
                    </a>
                <?php } ?>
			<?php endforeach; ?>
		</div>

		<div class="eltdf-sig-info clearfix">
			<div class="eltdf-sig-headline">
				<h2><?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?></h2>
				<div class="eltdf-sig-description">
					<?php echo esc_html($description); ?>
				</div>
			</div>

			<div class="eltdf-sig-thumbnails-holder">
				<?php foreach ( $image_items as $image_item ): ?>
					<div class="eltdf-sig-thumbnail">
						<?php echo wp_get_attachment_image($image_item['thumbnail'], 'full'); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

	<?php } ?>
</div>