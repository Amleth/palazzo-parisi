<?php
    $show_id = get_post_meta(get_the_ID(), 'eltdf_tc_events_shows_post_meta', true);

    echo musea_elated_execute_shortcode('eltdf_button', array(
        'type'      => 'outline-slit',
        'text'      => esc_html__('Get tickets', 'eltdf-shows'),
        'link'      => get_the_permalink(),
        'size'      => 'small',
        'background_color' => $params['button_background_color'],
        'color'     => $params['button_color'],
    ));
?>