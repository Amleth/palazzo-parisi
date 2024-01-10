<div class="eltdf-team-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="eltdf-team-image">
                <?php echo wp_get_attachment_image($team_image, 'full'); ?>
				<?php if ($team_link !== '') { ?>
                    <a class="eltdf-team-link" href="<?php echo esc_url($team_link) ?>" target="<?php echo esc_attr($team_target) ?>" ></a>
                <?php } ?>
                <?php if (!empty($team_social_icons)) { ?>
                    <div class="eltdf-team-social-holder">
                        <div class="eltdf-team-social-opener">
                            <span class="eltdf-icon-font-elegant social_share eltdf-team-icon-opener"></span>
                        </div>
                        <div class="eltdf-team-social-floating">
                            <?php foreach( $team_social_icons as $team_social_icon ) { ?>
                                <span class="eltdf-team-icon"><?php echo wp_kses_post($team_social_icon); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
			</div>
		<?php } ?>
		<div class="eltdf-team-info">
			<?php if ($team_name !== '') { ?>
				<<?php echo esc_attr($team_name_tag); ?> class="eltdf-team-name" <?php echo musea_elated_get_inline_style($team_name_styles); ?>><?php echo esc_html($team_name); ?></<?php echo esc_attr($team_name_tag); ?>>
			<?php } ?>
			<?php if ($team_position !== "") { ?>
				<div class="eltdf-team-position" <?php echo musea_elated_get_inline_style($team_position_styles); ?>><?php echo esc_html($team_position); ?></div>
			<?php } ?>
			<?php if ($team_text !== "") { ?>
				<p class="eltdf-team-text" <?php echo musea_elated_get_inline_style($team_text_styles); ?>><?php echo esc_html($team_text); ?></p>
			<?php } ?>
		</div>
	</div>
</div>