<div class="eltdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-testimonials eltdf-testimonials-image-pagination-inner" <?php echo musea_elated_get_inline_attrs( $data_attr ) ?>>

        <?php if ( $query_results->have_posts() ):
            $pagination_images = array();
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $title    = get_post_meta( get_the_ID(), 'eltdf_testimonial_title', true );
                $text     = get_post_meta( get_the_ID(), 'eltdf_testimonial_text', true );
                $author   = get_post_meta( get_the_ID(), 'eltdf_testimonial_author', true );
                $position = get_post_meta( get_the_ID(), 'eltdf_testimonial_author_position', true );
                $current_id = get_the_ID();
                $pagination_images[]  = get_the_post_thumbnail(get_the_ID(), array(35, 35));
                ?>

                <div class="eltdf-testimonial-content" id="eltdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
                    <div class="eltdf-testimonial-text-holder">
                        <?php if ( ! empty( $title ) ) { ?>
                            <h2 itemprop="name" class="eltdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h2>
                        <?php } ?>
                        <?php if ( ! empty( $text ) ) { ?>
                            <p class="eltdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                        <?php } ?>
                        <?php if ( ! empty( $author ) ) { ?>
                            <h4 class="eltdf-testimonial-author">
                                <span class="eltdf-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
                                <?php if ( ! empty( $position ) ) { ?>
                                    <span class="eltdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                                <?php } ?>
                            </h4>
                        <?php } ?>
                    </div>
                </div>

                <?php
            endwhile;
        else:
            echo esc_html__( 'Sorry, no posts matched your criteria.', 'musea-core' );
        endif;

        wp_reset_postdata();
        ?>
    </div>
    <ul id="eltdf-testimonial-pagination" class="clearfix" >
        <?php foreach ($pagination_images as $image) : ?>
            <li class="eltdf-tsp-item"> <?php echo musea_elated_get_module_part($image); ?> </li>
        <?php endforeach; ?>
    </ul>
</div>