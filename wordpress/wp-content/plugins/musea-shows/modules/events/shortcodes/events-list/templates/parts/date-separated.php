<?php $date = strtotime( get_post_meta( get_the_ID(), 'event_date_time', true ) ); ?>
<div class="eltdf-el-date-separated">
	<h2> <?php echo esc_html( date( 'd', $date ) ); ?> </h2>
	<p> <?php echo esc_html( date( 'F', $date ) ); ?> </p>
</div>