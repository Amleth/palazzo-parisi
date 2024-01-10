<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="eltdf-pli-image">
	<?php if ( has_post_thumbnail() ) {
		$image_src = get_the_post_thumbnail_url( get_the_ID() );
		
		if ( $thumb_size !== 'custom' ) {
			if ( strpos( $image_src, '.gif' ) !== false ) {
				echo get_the_post_thumbnail( get_the_ID(), 'full' );
			} else {
				echo get_the_post_thumbnail( get_the_ID(), $thumb_size );
			}
		} elseif ( isset( $custom_image_width ) && ! empty( $custom_image_width ) && isset( $custom_image_height ) && ! empty( $custom_image_height ) ) {
			echo musea_elated_generate_thumbnail( get_post_thumbnail_id( get_the_ID() ), null, intval( $custom_image_width ), intval( $custom_image_height ) );
		}
		?>
		<?php if ( ! empty( $params['item_type'] ) && 'gallery' === $params['item_type'] ) { ?>
			<a itemprop="url" class="eltdf-pli-link eltdf-block-drag-link" data-rel="prettyPhoto[single_pretty_photo]" href="<?php echo esc_url( $image_src ); ?>">
		<?php } else { ?>
            <a itemprop="url" class="eltdf-pli-link eltdf-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
        <?php } ?>
	            <div class="eltdf-pl-item-plus">
	                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	                     width="33px" height="33px" viewBox="0 0 33 33" enable-background="new 0 0 33 33" xml:space="preserve">
	                    <line stroke-miterlimit="10" x1="0" y1="16.5" x2="33" y2="16.5"/>
	                    <line stroke-miterlimit="10" x1="16.5" y1="0" x2="16.5" y2="33"/>
	                </svg>
	            </div>
            </a>
        <?php
		
	} else { ?>
		<img itemprop="image" class="eltdf-pl-original-image" width="800" height="600" src="<?php echo MUSEA_CORE_CPT_URL_PATH.'/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Portfolio Featured Image', 'musea-core'); ?>" />
		<?php if ( ! empty( $params['item_type'] ) && 'gallery' === $params['item_type'] ) { ?>
			<a itemprop="url" class="eltdf-pli-link eltdf-block-drag-link" data-rel="prettyPhoto[single_pretty_photo]" href="<?php echo esc_url( $image_src ); ?>">
		<?php } else { ?>
				<a itemprop="url" class="eltdf-pli-link eltdf-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
		<?php } ?>
            <div class="eltdf-pl-item-plus">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="33px" height="33px" viewBox="0 0 33 33" enable-background="new 0 0 33 33" xml:space="preserve">
                    <line stroke-miterlimit="10" x1="0" y1="16.5" x2="33" y2="16.5"/>
                    <line stroke-miterlimit="10" x1="16.5" y1="0" x2="16.5" y2="33"/>
                </svg>
            </div>
        </a>
	<?php } ?>
</div>
