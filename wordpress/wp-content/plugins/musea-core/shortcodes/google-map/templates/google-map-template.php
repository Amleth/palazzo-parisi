<div class="eltdf-google-map-holder">
	<?php if ( ! empty( $address1 ) && $enable_direction_link === 'yes' ) {
		$get_direction_link = 'https://maps.google.com?q=' . esc_attr( str_replace( array( ' ', ',' ), array( '+', '' ), $address1 ) );
		?>
		<a itemprop="url" class="eltdf-google-map-direction" href="<?php echo esc_url( $get_direction_link ); ?>" target="_blank"><?php esc_html_e( 'Get direction', 'musea-core' ); ?></a>
	<?php } ?>
	<div class="eltdf-google-map" id="<?php echo esc_attr( $map_id ); ?>" <?php echo wp_kses( $map_data, array( 'data' ) ); ?>></div>
	<?php if ( $params['snazzy_map_style'] === 'yes' ) { ?>
		<input type="hidden" class="eltdf-snazzy-map" value="<?php echo str_replace( '<br />', '', $params['snazzy_map_code'] ); ?>"/>
	<?php } ?>
	<?php if ( $scroll_wheel == 'no' ) { ?>
		<div class="eltdf-google-map-overlay"></div>
	<?php } ?>
</div>