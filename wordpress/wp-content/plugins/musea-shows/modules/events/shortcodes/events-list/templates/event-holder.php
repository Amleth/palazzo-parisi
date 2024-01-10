<div class="eltdf-event-list-holder <?php echo esc_attr($holder_classes); ?>">
    <?php if (! empty( $image )) { ?>
        <div class="eltdf-event-list-image-holder">
            <div class="eltdf-event-image">
                <?php echo wp_get_attachment_image( $image['image_id'], 'full' ); ?>
            </div>
        </div>
    <?php } ?>
    <div class="eltdf-event-list-holder-inner eltdf-outer-space clearfix">
        <?php
            if($query_results->have_posts()):
                while ( $query_results->have_posts() ) : $query_results->the_post();
                    echo musea_shows_get_module_shortcode_template_part('events', 'events-list', 'layout-collections/event-item', $item_style, $params);
                endwhile;
            else:
                echo musea_shows_get_module_shortcode_template_part('events', 'events-list', 'parts/posts-not-found');
            endif;

            wp_reset_postdata();
        ?>
    </div>
</div>