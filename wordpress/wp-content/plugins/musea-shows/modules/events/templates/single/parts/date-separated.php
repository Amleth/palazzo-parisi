<?php $date = strtotime( get_post_meta( get_the_ID(), 'event_date_time', true ) ); ?>
<div class="eltdf-event-single-date-separated">
	<h1> <?php echo esc_html( date( 'd', $date ) ); ?> </h1>
	<h6> <?php echo esc_html( date( 'F', $date ) ); ?> </h6>
</div>