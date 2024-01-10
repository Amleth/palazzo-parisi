<?php if ($enable_title === 'yes') {
    $title_tag = !empty($title_tag) ? $title_tag : 'h4';
    ?>
    <<?php echo esc_attr($title_tag); ?> itemprop="name" class="eltdf-sli-title entry-title">
    <?php echo esc_attr(get_the_title()); ?>
    </<?php echo esc_attr($title_tag); ?>>
<?php } ?>