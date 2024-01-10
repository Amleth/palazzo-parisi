<?php
$show_related = musea_elated_options()->getOptionValue('blog_single_related_posts') == 'yes';
$related_post_number = musea_elated_sidebar_layout() === 'no-sidebar' ? 4 : 3;
$related_posts_options = array(
    'posts_per_page' => $related_post_number
);
$related_posts = musea_elated_get_blog_related_post_type(get_the_ID(), $related_posts_options);
$related_posts_image_size = isset($related_posts_image_size) ? $related_posts_image_size : 'full';
?>
<?php if($show_related) { ?>
    <div class="eltdf-related-posts-holder clearfix">
        <?php if ( $related_posts && $related_posts->have_posts() ) : ?>
            <h4 class="eltdf-related-posts-title"><?php esc_html_e('Related Posts', 'musea' ); ?></h4>
            <div class="eltdf-related-posts-inner clearfix">
                <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                    <div class="eltdf-related-post">
                        <div class="eltdf-related-post-inner">
		                    <?php if (has_post_thumbnail()) { ?>
                            <div class="eltdf-related-post-image">
                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                     <?php the_post_thumbnail($related_posts_image_size); ?>
                                </a>
                            </div>
		                    <?php }	?>
                            <h4 itemprop="name" class="entry-title eltdf-post-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                            <div class="eltdf-post-info">
                                <?php musea_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
                                <?php musea_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif;
        wp_reset_postdata();
        ?>
    </div>
<?php } ?>