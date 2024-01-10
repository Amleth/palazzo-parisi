<?php
$rand = rand(0, 1000);
$link_class = !empty($play_button_hover_image) ? 'eltdf-vb-has-hover-image' : '';
?>
<div class="eltdf-video-button-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-video-button-image">
		<?php echo wp_get_attachment_image($video_image, 'full'); ?>
	</div>
	<?php if(!empty($play_button_image)) { ?>
		<a class="eltdf-video-button-play-image <?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="eltdf-video-button-play-inner">
				<?php echo wp_get_attachment_image($play_button_image, 'full'); ?>
				<?php if(!empty($play_button_hover_image)) { ?>
					<?php echo wp_get_attachment_image($play_button_hover_image, 'full'); ?>
				<?php } ?>
			</span>
		</a>
	<?php } else { ?>
		<a class="eltdf-video-button-play" <?php echo musea_elated_get_inline_style($play_button_styles); ?> href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="eltdf-video-button-play-inner">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="88px" height="88px" viewBox="0 0 88 88" enable-background="new 0 0 88 88" xml:space="preserve">
					<circle fill="none" stroke="#FFFFFF" stroke-miterlimit="10" cx="44" cy="44.001" r="43.5"></circle>
					<circle fill="none" stroke="#FFFFFF" stroke-miterlimit="10" cx="44" cy="44.001" r="43.5"></circle>
					<polygon fill="none" stroke="#FFFFFF" stroke-miterlimit="10" points="37.987,24.208 57.781,44.001 37.987,63.793 "></polygon>
				</svg>
			</span>
		</a>
	<?php } ?>
</div>