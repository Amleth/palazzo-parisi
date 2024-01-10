<div class="eltdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-testimonials eltdf-owl-slider eltdf-border-around" <?php echo musea_elated_get_inline_attrs( $data_attr ) ?>>

        <?php if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $title    = get_post_meta( get_the_ID(), 'eltdf_testimonial_title', true );
                $text     = get_post_meta( get_the_ID(), 'eltdf_testimonial_text', true );
                $author   = get_post_meta( get_the_ID(), 'eltdf_testimonial_author', true );
                $position = get_post_meta( get_the_ID(), 'eltdf_testimonial_author_position', true );

                $current_id = get_the_ID();
                ?>

                <div class="eltdf-testimonial-content eltdf-testimonials<?php echo esc_attr($current_id) ?>">
                    <div class="eltdf-testimonial-content-inner">
                        <div class="eltdf-testimonial-text-holder">
                            <div class="eltdf-testimonial-text-inner">
                                <?php if ( ! empty( $title ) ) { ?>
                                    <h4 class="eltdf-testimonial-title">
                                        <?php echo esc_html( $title ); ?>
                                    </h4>
                                <?php }?>
                                <?php if ( ! empty( $text ) ) { ?>
                                    <p class="eltdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="eltdf-testimonial-carousel-bottom">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <div class="eltdf-testimonial-image">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), array( 66, 66 ) ); ?>
                                </div>
                            <?php } ?>
                            <?php if ( ! empty( $author ) ) { ?>
                                <div class="eltdf-testimonial-author">
                                    <h5 class="eltdf-testimonials-author-name"><?php echo esc_html( $author ); ?></h5>
                                    <?php if ( ! empty( $position ) ) { ?>
                                        <h6 class="eltdf-testimonials-author-job"><?php echo esc_html( $position ); ?></h6>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
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
</div>