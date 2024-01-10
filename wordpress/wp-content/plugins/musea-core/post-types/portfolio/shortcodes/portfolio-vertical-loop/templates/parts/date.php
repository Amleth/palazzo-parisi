<div class="eltdf-pvl-info-item eltdf-pvl-date">
    <?php echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/info-title', 'standard', array( 'title' => esc_attr__('Date:', 'musea-core') )); ?>
    <p itemprop="dateCreated" class="eltdf-pvl-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
    <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(musea_elated_get_page_id()); ?>"/>
</div>
