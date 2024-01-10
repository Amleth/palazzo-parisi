<?php
$product = musea_elated_return_woocommerce_global_variable();

if ( $product->is_on_sale() ) { ?>
	<span class="eltdf-<?php echo esc_attr( $class_name ); ?>-onsale"><?php echo musea_elated_get_woocommerce_sale( $product ); ?></span>
<?php } ?>

<?php if ( ! $product->is_in_stock() ) { ?>
	<span class="eltdf-<?php echo esc_attr( $class_name ); ?>-out-of-stock"><?php esc_html_e( 'Sold', 'musea' ); ?></span>
<?php }

$new = get_post_meta( get_the_ID(), 'eltdf_show_new_sign_woo_meta', true );

if ( $new === 'yes' ) { ?>
	<span class="eltdf-<?php echo esc_attr( $class_name ); ?>-new-product"><?php esc_html_e( 'New', 'musea' ); ?></span>
<?php }

$product_image_size = 'woocommerce_single';
if ( $image_size === 'full' ) {
	$product_image_size = 'full';
} else if ( $image_size === 'square' ) {
	$product_image_size = 'musea_elated_image_square';
} else if ( $image_size === 'landscape' ) {
	$product_image_size = 'musea_elated_image_landscape';
} else if ( $image_size === 'portrait' ) {
	$product_image_size = 'musea_elated_image_portrait';
} else if ( $image_size === 'medium' ) {
	$product_image_size = 'medium';
} else if ( $image_size === 'large' ) {
	$product_image_size = 'large';
} else if ( $image_size === 'woocommerce_thumbnail' ) {
	$product_image_size = 'woocommerce_thumbnail';
}

$fixed_image_size_meta = get_post_meta( get_the_ID(), 'eltdf_product_featured_image_size', true );
if ( ! empty( $fixed_image_size_meta ) && isset( $type ) && $type === 'masonry' ) {
	if ( $fixed_image_size_meta === 'small' ) {
		$product_image_size = 'musea_elated_image_square';
	} else if ( $fixed_image_size_meta === 'large-width' ) {
		$product_image_size = 'musea_elated_image_landscape';
	} else if ( $fixed_image_size_meta === 'large-height' ) {
		$product_image_size = 'musea_elated_image_portrait';
	} else if ( $fixed_image_size_meta === 'large-width-height' ) {
		$product_image_size = 'musea_elated_image_huge';
	}
}

if ( has_post_thumbnail() ) {
	the_post_thumbnail( apply_filters( 'musea_elated_filter_product_list_image_size', $product_image_size ) );
}