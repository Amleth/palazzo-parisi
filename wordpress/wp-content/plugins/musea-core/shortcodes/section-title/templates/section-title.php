<div class="eltdf-section-title-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo musea_elated_get_inline_style( $holder_styles ); ?>>
	<div class="eltdf-st-inner">
        <?php if ( ! empty( $caption ) ) { ?>
            <<?php echo esc_attr( $caption_tag ); ?> class="eltdf-st-caption" <?php echo musea_elated_get_inline_style( $caption_styles ); ?>>
                <span class="eltdf-st-caption-inner" ><?php echo esc_attr( $caption ); ?></span>
            </<?php echo esc_attr( $caption_tag ); ?>>
        <?php } ?>
		<?php if ( ! empty( $title ) ) { ?>
			<<?php echo esc_attr( $title_tag ); ?> class="eltdf-st-title" <?php echo musea_elated_get_inline_style( $title_styles ); ?>>
    <span class="eltdf-st-title-inner"><span class="eltdf-st-side-line-left" <?php echo musea_elated_get_inline_style( $decorative_line_styles ); ?>></span><?php echo wp_kses( $title, array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?><span class="eltdf-st-side-line-right" <?php echo musea_elated_get_inline_style( $decorative_line_styles ); ?>></span></span>
			</<?php echo esc_attr( $title_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<<?php echo esc_attr( $text_tag ); ?> class="eltdf-st-text" <?php echo musea_elated_get_inline_style( $text_styles ); ?>>
				<?php echo wp_kses( $text, array( 'br' => true ) ); ?>
			</<?php echo esc_attr( $text_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $button_parameters ) ) { ?>
			<div class="eltdf-st-button"><?php echo musea_elated_get_button_html( $button_parameters ); ?></div>
		<?php } ?>
	</div>
</div>