<?php $email = get_post_meta(get_the_ID(), 'eltdf_role_member_email', true); ?>

<div class="eltdf-role-member-content">
	<?php the_content(); ?>
</div>
<h4 class="eltdf-rs-contact-title"> <?php echo esc_html__('Contact:' , 'musea-shows'); ?></h4>
<?php if(!empty($email)) { ?>
    <h6 class="eltdf-rs-email">
        <a href="mailto:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a>
    </h6>
<?php } ?>
<p class="eltdf-rs-social">
    <?php foreach ($social_icons as $social_icon) {
        echo wp_kses_post($social_icon);
    } ?>
</p>