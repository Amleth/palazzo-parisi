<?php
    $post_id = get_the_ID();

    global $wpdb;

    //post_type condition was added because of the tickera plugin API which creates another item under the same meta name

    $post_meta_infos = $wpdb->get_results( $wpdb->prepare("SELECT a.post_id AS ticket_id, a.meta_key AS meta_key, a.meta_value AS meta_value  
                                    FROM {$wpdb->postmeta} AS a
                                    LEFT JOIN (SELECT id, post_type FROM {$wpdb->posts} ) AS b ON a.post_id = b.id
                                    WHERE b.post_type = 'tc_tickets' AND a.meta_key = 'event_name' AND a.meta_value = %d", $post_id), ARRAY_A);

?>

<?php if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) { ?>
    <div class="eltdf-shows-events-tickets-holder">
        <ul class="eltdf-shows-events-tickets">
            <?php foreach ($post_meta_infos as $values) { ?>
                <li class="eltdf-se-ticket">
                    <div class="eltdf-set-price">
                        <h2> <?php echo do_shortcode('[ticket_price id="'.$values['ticket_id'].'"]') ?> </h2>
                    </div>
                    <div class="eltdf-set-title">
                        <h4> <?php echo get_the_title($values['ticket_id']); ?> </h4>
                    </div>
                    <div class="eltdf-set-button">
                        <?php echo do_shortcode('[tc_ticket id="'.$values['ticket_id'].'" title="'.esc_attr__('Get ticket', 'musea-shows').'"]'); ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>