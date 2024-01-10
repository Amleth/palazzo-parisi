<li>
    <div class="<?php echo esc_attr( $comment_class ); ?>">
        <?php if ( ! $is_pingback_comment ) { ?>
            <div class="eltdf-comment-image"> <?php echo musea_elated_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
        <?php } ?>
        <div class="eltdf-comment-text">
            <div class="eltdf-comment-info">
                <h5 class="eltdf-comment-name vcard">
                    <?php echo wp_kses_post( get_comment_author_link() ); ?>
                </h5>
                <div class="eltdf-review-rating">
                    <?php foreach($rating_criteria as $rating) { ?>
                        <?php if(!isset($rating['show']) || (isset($rating['show']) && $rating['show'])) { ?>
                            <span class="eltdf-rating-inner">
                                <?php if ( isset( $rating['label'] ) && ! empty( $rating['label'] ) ) { ?>
	                                <span class="eltdf-rating-label">
						                <?php echo esc_html( $rating['label'] ); ?>
						            </span>
                                <?php } ?>
	                            <span class="eltdf-rating-value">
                                    <?php
                                    $review_rating = get_comment_meta( $comment->comment_ID, $rating['key'], true );

                                    for ( $i = 1; $i <= 5; $i ++ ) {
	                                    if ( $i <= $review_rating ) { ?>
		                                    <i class="fa fa-star" aria-hidden="true"></i>
	                                    <?php } else { ?>
		                                    <i class="far fa-star" aria-hidden="true"></i>
	                                    <?php }
                                    } ?>
                                </span>
                            </span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php if ( ! $is_pingback_comment ) { ?>
                <div class="eltdf-text-holder" id="comment-<?php comment_ID(); ?>">
                    <div class="eltdf-review-title">
                        <span><?php echo esc_html( $review_title ); ?></span>
                    </div>
                    <?php comment_text(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<!-- li is closed by wordpress after comment rendering -->