<?php if ( is_object( WC()->cart ) ) { ?>
<?php musea_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/opener', 'woocommerce' ); ?>
<div class="eltdf-sc-dropdown">
	<div class="eltdf-sc-dropdown-inner">
		<?php if ( ! WC()->cart->is_empty() ) {
			musea_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/loop', 'woocommerce' );
			
			musea_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/order-details', 'woocommerce' );
			
			musea_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/button', 'woocommerce' );
		} else {
			musea_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/posts-not-found', 'woocommerce' );
		} ?>
	</div>
</div>
<?php } ?>