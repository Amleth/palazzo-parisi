<?php
$image_meta          = get_post_meta( get_the_ID(), 'eltdf_show_list_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail( $show_id );
$show_list_image_id  = ! empty( $image_meta ) ? musea_elated_get_attachment_id_from_url( $image_meta ) : '';
$excerpt             = get_the_excerpt($show_id);

$events_array = array();
$events       = get_post_meta( get_the_ID(), 'eltdf_show_events', true );
if ( ! empty( $events ) ) {
    foreach ( $events as $event ) {
        $events_array[] = $event['events'];
    }
}

$params['events'] = $events_array;
?>

<div class="eltdf-show eltdf-item-space <?php echo esc_attr($article_classes) ?>">
	<div class="eltdf-show-inner">
		<?php if ( $has_featured ) { ?>
			<div class="eltdf-show-image">
				<a itemprop="url" href="<?php echo esc_url(get_the_permalink($show_id)) ?>" target="_self">
					<?php if ( ! empty( $show_list_image_id ) ) {
						echo wp_get_attachment_image( $show_list_image_id, $image_proportions );
					} else { ?>
						<?php echo get_the_post_thumbnail(get_the_ID(), $image_proportions); ?>
					<?php } ?>
				</a>
			</div>
		<?php } ?>
		<div class="eltdf-show-info">
            <div class="eltdf-show-info-wrapper">
                <?php if(!empty($category) && $show_category == 'yes') { ?>
                    <div class="eltdf-show-categories-holder">
                        <?php foreach ($category as $cat) { ?>
                            <a itemprop="url" class="eltdf-show-categories" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if( $show_date_range == 'yes' ) { ?>
                    <div class="eltdf-show-date-holder">
                        <div class="eltdf-show-date">
                            <?php musea_shows_get_cpt_single_module_template_part('templates/single/parts/period', 'shows', '', $params); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="eltdf-show-title-holder">
                    <<?php echo esc_attr($title_tag); ?> itemprop="name" class="eltdf-show-name entry-title">
                        <a itemprop="url" href="<?php echo esc_url(get_the_permalink($show_id)) ?>"><?php echo esc_html(get_the_title(get_the_ID())) ?></a>
                    </<?php echo esc_attr($title_tag);?>>
                </div>
            </div>
            <?php if(!empty($excerpt)) { ?>
                <div class="eltdf-show-excerpt-holder">
                    <span><?php echo esc_html($excerpt); ?></span>
                </div>
            <?php } ?>
            <div class="eltdf-event-post-read-more-button">
                <?php
                $button_params = array(
                    'type'         => 'simple',
                    'link'         => get_the_permalink(),
                    'text'         => esc_html__( 'View more', 'musea-show' ),
                    'custom_class' => 'eltdf-blog-list-button'
                );

                echo musea_elated_return_button_html( $button_params );
                ?>
            </div>
		</div>
	</div>
</div>
