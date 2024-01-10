<div class="eltdf-workflow <?php echo esc_attr($custom_clas) ?>">
    <span class="alt-line"></span>
    <span class="main-line" style="<?php echo esc_attr($main_line_style); ?>"></span>
    <?php echo do_shortcode( preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
    <div class="eltdf-workflow-item eltdf-wi-hidden">
        <div class="eltdf-workflow-item-inner">
            <div class="eltdf-workflow-text">
                <span class="circle"></span>
            </div>
        </div>
    </div>
</div>