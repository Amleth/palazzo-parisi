<div class="eltdf-show-location-holder">
    <div class="eltdf-show-role">
        <h6 class="eltdf-show-role-title"><?php echo esc_html__('Location', 'eltdf-shows'); ?></h6>
        <ul>
            <li>
                <?php $link = get_post_meta(get_the_ID(), 'eltdf_show_custom_location_link'); ?>
            <?php if( !empty($link)){ ?>
                    <a href="<?php echo $link[0]; ?>" target="_blank"><?php echo get_post_meta(get_the_ID(), 'eltdf_show_custom_location', true) ?></a>
                <?php } else{?>
                    <p><?php echo get_post_meta(get_the_ID(), 'eltdf_show_custom_location', true) ?></p>
                <?php } ?>
            </li>
        </ul>
    </div>
</div>