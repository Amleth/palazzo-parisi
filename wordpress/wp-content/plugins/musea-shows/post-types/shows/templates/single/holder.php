<div class="eltdf-container">
    <div class="eltdf-container-inner clearfix">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="eltdf-shows-single-holder <?php echo esc_attr($holder_classes); ?>">
                <?php if(post_password_required()) {
                    echo get_the_password_form();
                } else {
                    do_action('musea_elated_action_shows_page_before_content');
                
                    musea_shows_get_cpt_single_module_template_part('templates/single/layout-collections/show-single', 'shows', '', $params);
                
                    do_action('musea_elated_action_shows_page_after_content');

                    musea_shows_get_cpt_single_module_template_part('templates/single/parts/comments', 'shows');
                } ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>