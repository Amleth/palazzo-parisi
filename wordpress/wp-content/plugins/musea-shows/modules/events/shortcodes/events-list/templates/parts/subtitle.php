<?php
    $subtitle = get_post_meta(get_the_ID(), 'eltdf_tc_events_subtitle_post_meta', true);
?>
<p itemprop="name" class="eltdf-eli-subtitle">
    <?php echo esc_html($subtitle); ?>
</p>
