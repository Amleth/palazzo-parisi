<?php

$image_meta = get_post_meta(get_the_ID(), 'eltdf_show_list_image_meta', true);
$show_list_image_id  = ! empty( $image_meta ) ? musea_elated_get_attachment_id_from_url( $image_meta ) : '';

?>


<?php
 if(musea_shows_is_tickera_installed() && !empty($events)){ ?>


     <div class="eltdf-events-list">

         <div class="eltdf-event-image">
             <?php echo wp_get_attachment_image( $show_list_image_id, 'full' ); ?>
         </div>
        <div class="eltdf-event-list-wrapper">
         <?php foreach ($events as $event_id) : ?>
             <?php $date = strtotime(get_post_meta($event_id, 'event_date_time', true)); ?>
             <div class="eltdf-event-list-item">
                 <div class="eltdf-event-date">
                     <h2> <?php echo date_i18n('d',$date); ?> </h2>
                     <p> <?php echo date_i18n('F',$date); ?> </p>
                 </div>
                 <div class="eltdf-event-title">
                     <h3> <?php echo  get_the_title($event_id) ?> </h3>
                     <p> <?php echo get_post_meta($event_id, 'eltdf_tc_events_subtitle_post_meta', true)?></p>
                 </div>
                 <div class="eltdf-event-button-holder">
                     <?php echo musea_elated_execute_shortcode('eltdf_button', array(
                             'type'     => 'outline-slit',
                             'size'     => 'small',
                             'text'     => esc_html__('Get tickets', 'eltdf-shows'),
                             'link'     => get_the_permalink($event_id)
                     )); ?>
                 </div>
             </div>
         <?php endforeach; ?>
        </div>
     </div>
<?php } ?>