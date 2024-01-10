<?php
$title_tag       = 'span';
$quote_text_meta = get_post_meta(get_the_ID(), "eltdf_post_quote_text_meta", true );

$post_title      = !empty($quote_text_meta) ? $quote_text_meta : get_the_title();

$post_author     = get_post_meta(get_the_ID(), "eltdf_post_quote_author_meta", true );
$post_author_job = get_post_meta(get_the_ID(), "eltdf_post_quote_author_job_meta", true );
?>

<div class="eltdf-post-quote-holder">
    <div class="eltdf-post-quote-holder-inner">
        <<?php echo esc_attr($title_tag);?> itemprop="name" class="eltdf-quote-title eltdf-post-title">
        <?php if(musea_elated_blog_item_has_link()) { ?>
            <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php } ?>
            <?php echo esc_html($post_title); ?>
        <?php if(musea_elated_blog_item_has_link()) { ?>
            </a>
        <?php } ?>
        </<?php echo esc_attr($title_tag);?>>
        <?php if($post_author != '') { ?>
            <h6 class="eltdf-quote-author">
                <?php echo esc_html($post_author); ?>
            </h6>
        <?php } ?>
        <?php if($post_author_job != '') { ?>
            <div class="eltdf-quote-author-job">
                    <?php echo esc_html($post_author_job); ?>
            </div>
        <?php } ?>
    </div>
</div>