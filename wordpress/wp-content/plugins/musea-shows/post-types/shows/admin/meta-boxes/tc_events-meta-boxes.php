<?php

//Each meta box added to tc_events must have post meta sufix inside the name param

if ( ! function_exists( 'musea_elated_map_events_meta' ) ) {
    function musea_elated_map_events_meta() {

        if( musea_shows_is_tickera_installed() ){
            $shows = musea_shows_get_shows_array();
        }

        $events_meta_box = musea_elated_create_meta_box(
            array(
                'scope' => array( 'tc_events' ),
                'title' => esc_html__( 'Events Meta', 'musea-show' ),
                'name'  => 'tc_events-meta'
            )
        );

        musea_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_tc_events_subtitle_post_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Single Event Subtitle', 'musea-show' ),
                'description' => esc_html__( 'Enter the subtitle that will be shown in the ticket list for this event', 'musea-show' ),
                'parent'      => $events_meta_box
            )
        );

        if (musea_shows_is_tickera_installed()) {

            musea_elated_create_meta_box_field(
                array(
                    'name' => 'eltdf_tc_events_shows_post_meta',
                    'type' => 'selectblank',
                    'label' => esc_html__('Single Event Show', 'musea-show'),
                    'description' => esc_html__('Select the show that the event will link to from the event list shortcode', 'musea-show'),
                    'default' => '',
                    'options' => $shows,
                    'parent' => $events_meta_box
                )
            );
        }
    }

    add_action( 'musea_elated_action_meta_boxes_map', 'musea_elated_map_events_meta', 99 );
}


if( ! function_exists('musea_elated_filter_event_metas')){

    /*
     * meta key needs to be changed because of the default plugin meta field save options
     * \plugins\tickera-event-ticketing-system\includes\addons\better-events\index.php
     */

    function musea_elated_filter_event_metas($metas){

        foreach ($metas as $key => $value){

            if( preg_match('/eltdf_tc_events_/', $key ) && !preg_match('/_post_meta/', $key )){
                unset($metas[$key]);
                $key = $key . '_post_meta';
                $metas[$key] = $value;
            }

        }

        return $metas;

    }

    add_filter('events_metas', 'musea_elated_filter_event_metas', 10, 1);

}
