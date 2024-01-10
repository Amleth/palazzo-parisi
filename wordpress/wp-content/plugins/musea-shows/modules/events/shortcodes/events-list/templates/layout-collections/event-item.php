<?php
    $show_id = get_post_meta(get_the_ID(), 'eltdf_tc_events_shows_post_meta', true);
    $link = '';
    if(!empty($show_id)){
        $link = get_the_permalink($show_id);
    }
    else{
        $link = get_the_permalink(get_the_ID());
    }
?>
<div class="eltdf-event-list-item">
    <div class="eltdf-eli-date-holder">
        <?php echo musea_shows_get_module_shortcode_template_part('events', 'events-list', 'parts/date-separated', '', $params); ?>
    </div>
    <div class="eltdf-eli-title-holder">
        <a href="<?php echo musea_elated_get_module_part($link); ?>">
            <?php echo musea_shows_get_module_shortcode_template_part('events', 'events-list', 'parts/title', '', $params); ?>
        </a>
        <?php echo musea_shows_get_module_shortcode_template_part('events', 'events-list', 'parts/subtitle', '', $params); ?>
    </div>
    <div class="eltdf-eli-read-more-holder clearfix">
        <?php echo musea_shows_get_module_shortcode_template_part('events', 'events-list', 'parts/read-more', '', $params); ?>
    </div>
</div>
