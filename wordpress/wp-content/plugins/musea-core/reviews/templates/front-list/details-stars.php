<span class="eltdf-stars">
    <?php foreach ( $post_ratings as $rating ) { ?>
	    <span class="eltdf-stars-wrapper-inner">
            <span class="eltdf-stars-items">
                <?php
                $review_rating = musea_core_post_average_rating( $rating );
                for ( $i = 1; $i <= $review_rating; $i ++ ) { ?>
	                <i class="fa fa-star" aria-hidden="true"></i>
                <?php } ?>
            </span>
		    <?php if ( isset( $rating['label'] ) && ! empty( $rating['label'] ) ) { ?>
			    <span class="eltdf-stars-label">
	                <?php echo esc_html( $rating['label'] ); ?>
	            </span>
		    <?php } ?>
        </span>
    <?php } ?>
</span>
<a itemprop="url" class="eltdf-post-info-comments" href="<?php comments_link(); ?>">
    <span class="eltdf-reviews-number">
        <?php echo esc_html( $rating_number ); ?>
    </span>
	<span class="eltdf-reviews-label">
        <?php echo esc_html( $rating_label ); ?>
    </span>
</a>