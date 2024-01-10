<div class="eltdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-testimonials eltdf-owl-slider" <?php echo musea_elated_get_inline_attrs( $data_attr ) ?>>

    <?php if ( $query_results->have_posts() ):
        while ( $query_results->have_posts() ) : $query_results->the_post();
            $title    = get_post_meta( get_the_ID(), 'eltdf_testimonial_title', true );
            $text     = get_post_meta( get_the_ID(), 'eltdf_testimonial_text', true );
            $author   = get_post_meta( get_the_ID(), 'eltdf_testimonial_author', true );
            $position = get_post_meta( get_the_ID(), 'eltdf_testimonial_author_position', true );

            $current_id = get_the_ID();
    ?>

            <div class="eltdf-testimonial-content" id="eltdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
                <div class="eltdf-testimonial-text-holder">
                    <div class="eltdf-testimonials-quotes-holder">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="24.615px" height="18.233px" viewBox="0 0 24.615 18.233" enable-background="new 0 0 24.615 18.233" xml:space="preserve">
                            <g>
                                <path fill="#4E4E4E" d="M19.542,0.007c-1.33,0.165-1.92,0.869-3,3.15v0.75c0,0,3.899,1.604,4.283,4.476
                                    c0.383,2.862-0.953,6.567-7.658,8.499v1.352c0,0,7.399-1.41,10.342-7.426C27.035,3.596,21.148-0.192,19.542,0.007z"/>
                                <path fill="#4E4E4E" d="M6.375,0.007c-1.33,0.165-1.92,0.869-3,3.15v0.75c0,0,3.899,1.604,4.283,4.476
                                    C8.041,11.245,6.705,14.95,0,16.882v1.352c0,0,7.399-1.41,10.342-7.426C13.868,3.596,7.981-0.192,6.375,0.007z"/>
                            </g>
                        </svg>
                    </div>
                    <?php if ( ! empty( $text ) ) { ?>
                        <p class="eltdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                    <?php } ?>
                    <?php if ( ! empty( $author ) ) { ?>
                        <h6 class="eltdf-testimonial-author">
                            <?php if ( ! empty( $author ) ) { ?>
                                <span class="eltdf-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
                            <?php } ?>
                        </h6>
                        <div>
                            <?php if ( ! empty( $position ) ) { ?>
                                <div class="eltdf-testimonials-author-job"><?php echo esc_html( $position ); ?></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="eltdf-testimonial-image">
                        <?php echo get_the_post_thumbnail( get_the_ID(), array( 66, 66 ) ); ?>
                    </div>
                <?php } ?>
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