<?php
    $shows = get_post_meta(get_the_ID(), 'eltdf_show_performances', true);
    $shows_array = array();

    foreach ($shows as $show){
        $shows_array[] =  $show['shows'];
    }

?>

<h4 class="eltdf-info-title"> <?php echo esc_html__('Performances:', 'musea-shows'); ?> </h4>
<ul class="eltdf-performance-list">
    <?php foreach ($shows_array as $showId) : ?>
        <li>
            <div class="eltdf-show-title">
                <h6> <a href="<?php echo get_the_permalink($showId) ?>"> <?php echo  get_the_title($showId) ?> </a> </h6>
            </div>
        </li>
    <?php endforeach; ?>

</ul>
