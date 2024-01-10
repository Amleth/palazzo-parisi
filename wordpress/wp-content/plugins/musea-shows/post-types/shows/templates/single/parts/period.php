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
<div class="eltdf-show-roles-holder">
    <div class="eltdf-show-role">
        <h6 class="eltdf-show-role-title"><?php echo esc_html__('Date', 'eltdf-shows'); ?></h6>
        <ul>
            <li>
                <p><?php echo esc_html($oldest) ?> - <?php echo esc_html($newest) ?></p>
            </li>
        </ul>
    </div>
</div>
<?php
