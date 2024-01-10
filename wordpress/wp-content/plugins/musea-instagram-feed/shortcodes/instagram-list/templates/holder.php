<div class="eltdf-instagram-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo musea_elated_get_inline_attrs( $data_attr ) ?>>
    <?php if ( is_array( $images_array ) && count( $images_array ) ) { ?>
	    <ul class="eltdf-instagram-feed eltdf-outer-space <?php echo esc_attr($carousel_classes); ?> clearfix">
	    <?php
	    foreach ( $images_array as $image ) { ?>
		    <li class="eltdf-il-item eltdf-item-space">
			    <a href="<?php echo esc_url( $instagram_api->getHelper()->getImageLink( $image ) ); ?>" target="_blank">
				    <?php echo musea_elated_kses_img( $instagram_api->getHelper()->getImageHTML( $image ) ); ?>
				    <?php if ($show_instagram_icon =='yes' ) { ?>
                        <span class="eltdf-instagram-icon"><i class="social_instagram"></i></span>
				    <?php } ?>
			    </a>
		    </li>
	    <?php } ?>
    </ul>
    <?php } else { ?>
        <div class="eltdf-instagram-not-connected">
            <?php esc_html_e( 'It seams that you haven\'t connected with your Instagram account', 'musea-instagram-feed' ); ?>
        </div>
    <?php } ?>
</div>