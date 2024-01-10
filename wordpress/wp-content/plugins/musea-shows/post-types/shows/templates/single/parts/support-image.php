<?php
$image_meta = get_post_meta( get_the_ID(), 'eltdf_show_support_image_meta', true );
$show_list_image_id  = ! empty( $image_meta ) ? musea_elated_get_attachment_id_from_url( $image_meta ) : '';
$custom_link = get_post_meta( get_the_ID(), 'eltdf_show_custom_link', true );
?>

<div class="eltdf-single-show-image">
	<a itemprop="url" href="<?php echo esc_url($custom_link); ?>">
		<?php echo wp_get_attachment_image( $show_list_image_id, 'full' ); ?>
	</a>
</div>
