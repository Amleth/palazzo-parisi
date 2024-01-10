<a itemprop="url" <?php musea_elated_class_attribute( musea_elated_get_dropdown_cart_icon_class() ); ?> href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="eltdf-sc-opener-icon"><?php echo musea_elated_get_icon_sources_html( 'dropdown_cart', false, array( 'dropdown_cart' => 'yes' ) ); ?></span>
	<span class="eltdf-sc-opener-count"><?php echo WC()->cart->cart_contents_count; ?></span>
</a>