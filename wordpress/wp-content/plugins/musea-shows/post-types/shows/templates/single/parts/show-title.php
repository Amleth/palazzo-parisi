<?php

$oldest = 0;
$newest = 0;

if(musea_shows_is_tickera_installed() && !empty($events)) {
    $dates = array();

    foreach ($events as $event_id) {
        $dates[] = get_post_meta($event_id, 'event_date_time', true);
	    $dates[] = get_post_meta($event_id, 'event_end_date_time', true);
    }

    $max = max(array_map('strtotime', $dates));
    $min = min(array_map('strtotime', $dates));
    $newest = date('M j Y', $max);
    $oldest = date('M j', $min);
} else{
    $oldest = get_the_date('M j Y');
    $newest = get_the_date('M j Y');
}
?>
<div class="eltdf-event-section-title">
    <?php   echo musea_elated_execute_shortcode('eltdf_section_title', array (
        'title'               => get_the_title(get_the_ID()),
        'caption'             => $oldest.' - '.$newest,
        'position'            => 'center',
        'title_tag'           => 'h1'
    )); ?>
</div>
