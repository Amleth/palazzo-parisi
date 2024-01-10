<?php
$image_meta          = get_post_meta( $member_id, 'eltdf_role_list_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail( $member_id );
$role_list_image_id  = ! empty( $image_meta ) ? musea_elated_get_attachment_id_from_url( $image_meta ) : '';
$aux_class 			 =  ($appear_animation == 'yes') ? 'eltdf-hidden-item' : '';
?>

<div class="eltdf-role eltdf-item-space <?php echo esc_attr($role_member_layout) ?> <?php echo esc_attr($aux_class); ?>">
	<div class="eltdf-role-inner">
		<?php if ( $has_featured && $show_image == 'yes' ) { ?>
			<div class="eltdf-role-image">
				<a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>" target="_self">
					<?php if ( ! empty( $role_list_image_id ) ) {
						echo wp_get_attachment_image( $role_list_image_id, 'full' );
					} else { ?>
						<?php echo get_the_post_thumbnail($member_id, 'full'); ?>
					<?php } ?>
				</a>
			</div>
		<?php } ?>
		<div class="eltdf-role-info">
            <div class="eltdf-role-title-holder">
                <h5 itemprop="name" class="eltdf-role-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                </h5>

                <?php if (!empty($position)) { ?>
                    <h6 class="eltdf-role-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt)) { ?>
				<div class="eltdf-role-text">
					<div class="eltdf-role-text-inner">
						<div class="eltdf-role-description">
							<p itemprop="description" class="eltdf-role-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if($show_social_icons == 'yes') { ?>
				<div class="eltdf-role-social-holder-between">
					<div class="eltdf-role-social">
						<div class="eltdf-role-social-inner">
							<div class="eltdf-role-social-wrap">
								<?php foreach ($role_social_icons as $role_social_icon) {
									echo wp_kses_post($role_social_icon);
								} ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>