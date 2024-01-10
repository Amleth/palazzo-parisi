<div class="eltdf-single-show-title-holder">
    <?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/show-title', 'shows', '', $params); ?>
</div>
<div class="eltdf-single-show-image-holder">
    <?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/image', 'shows', '', $params); ?>
</div>
<div class="eltdf-single-show-main-content">
    <div class="eltdf-single-show-description eltdf-grid-col-9">
        <?php echo do_shortcode(get_post_meta(get_the_ID(), 'eltdf_shows_description', true)); ?>
        <div class="eltdf-single-show-social-share">
            <?php

            $show_social_share =  musea_elated_options()->getOptionValue( 'enable_social_share_on_show-item' );

            if ( ( $show_social_share == 'yes' ) ) {
                musea_shows_get_cpt_single_module_template_part('templates/single/parts/social-share', 'shows', '', $params);
            }
            ?>
        </div>
    </div>
    <div class="eltdf-single-show-side-content eltdf-grid-col-3">
        <?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/period', 'shows', '', $params); ?>
        <?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/location', 'shows', '', $params); ?>
        <?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/roles', 'shows', '', $params); ?>
        <?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/support-image', 'shows', '', $params); ?>
    </div>
</div>
<?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/events', 'shows', '', $params); ?>
<?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/content', 'shows', '', $params); ?>
