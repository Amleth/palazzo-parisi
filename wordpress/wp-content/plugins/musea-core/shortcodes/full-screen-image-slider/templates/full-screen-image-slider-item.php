<div class="eltdf-fsis-item">
	<div class="eltdf-fsis-image" <?php musea_elated_inline_style( $image_styles ); ?>>
		<div class="eltdf-fsis-image-wrapper">
			<div class="eltdf-fsis-image-inner">
				<?php if ( ! empty( $image_top ) ) { ?>
					<div class="eltdf-fsis-content-image eltdf-fsis-image-top">
						<?php echo wp_get_attachment_image( $image_top, 'full' ); ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $image_left ) ) { ?>
					<div class="eltdf-fsis-content-image eltdf-fsis-image-left">
						<?php echo wp_get_attachment_image( $image_left, 'full' ); ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $image_right ) ) { ?>
					<div class="eltdf-fsis-content-image eltdf-fsis-image-right">
						<?php echo wp_get_attachment_image( $image_right, 'full' ); ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $title ) ) { ?>
					<<?php echo esc_attr( $title_tag ); ?> class="eltdf-fsis-title" <?php echo musea_elated_get_inline_style( $title_styles ); ?>><?php echo wp_kses( $title, array( 'br' => true ) ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php } ?>
				<?php if ( ! empty( $subtitle ) ) { ?>
					<<?php echo esc_attr( $subtitle_tag ); ?> class="eltdf-fsis-subtitle" <?php echo musea_elated_get_inline_style( $subtitle_styles ); ?>><?php echo wp_kses( $subtitle, array( 'br' => true ) ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="eltdf-fsis-frame eltdf-fsis-frame-top"></div>
	<div class="eltdf-fsis-frame eltdf-fsis-frame-right"></div>
	<div class="eltdf-fsis-frame eltdf-fsis-frame-bottom"></div>
	<div class="eltdf-fsis-frame eltdf-fsis-frame-left"></div>
</div>