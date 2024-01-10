<div class="eltdf-sc-dropdown-items">
	<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		
		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			?>
			<div class="eltdf-sc-dropdown-item">
				<div class="eltdf-sc-dropdown-item-image">
					<?php
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					
					if ( ! $product_permalink ) {
						echo wp_kses_post( $thumbnail );
					} else {
						printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
					}?>
				</div>
				<div class="eltdf-sc-dropdown-item-content">
					<h6 itemprop="name" class="eltdf-sc-dropdown-item-title entry-title">
						<?php if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						} ?>
					</h6>
                    <?php
                        if ($cart_item['quantity'] > 1){ ?>
                            <p class="eltdf-sc-dropdown-item-quantity"><?php echo sprintf( esc_html__( '%s pieces', 'musea' ), esc_attr( $cart_item['quantity'] ) ); ?></p>
                        <?php } else{ ?>
                            <p class="eltdf-sc-dropdown-item-quantity"><?php echo sprintf( esc_html__( '%s piece', 'musea' ), esc_attr( $cart_item['quantity'] ) ); ?></p>
                        <?php }?>
					<p class="eltdf-sc-dropdown-item-price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></p>
                    <?php
                    $close_svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="10.109px" height="10.094px" viewBox="0 0 10.109 10.094" enable-background="new 0 0 10.109 10.094" xml:space="preserve">
                                    <line fill="none" stroke="#4E4E4E" stroke-miterlimit="10" x1="0.397" y1="0.389" x2="9.728" y2="9.719"/>
                                    <line fill="none" stroke="#4E4E4E" stroke-miterlimit="10" x1="9.728" y1="0.389" x2="0.397" y2="9.719"/>
                                    </svg>';
                    ?>
					<?php echo sprintf( '<a href="%s" class="eltdf-sc-dropdown-item-remove remove" title="%s">%s</span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'musea' ), $close_svg ); ?>
				</div>
			</div>
		<?php }
	} ?>
</div>