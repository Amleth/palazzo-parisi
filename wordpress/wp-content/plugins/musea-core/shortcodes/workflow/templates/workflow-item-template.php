<div class="eltdf-workflow-item">
    <span class="line" style="<?php echo esc_attr($line_color); ?>"></span>
    <div class="eltdf-workflow-item-inner">
        <div class="eltdf-workflow-image">
            <?php if(!empty($image)){
                echo wp_get_attachment_image($image, 'full');
            } ?>
        </div>
        <div class="eltdf-workflow-text">
            <span class="circle" style="<?php echo esc_attr($circle_border_color.$circle_background_color); ?>"></span>
            <span class="circle-line" style="<?php echo esc_attr($circle_background_color); ?>"></span>
            <?php if(!empty($year)){ ?>
                <div class="year"><?php echo esc_attr($year) ?></div>
            <?php } ?>
            <div class="eltdf-workflow-title-text-holder">
                <?php if(!empty($year)){ ?>
                    <div class="year-responsive"><?php echo esc_attr($year) ?></div>
                <?php } ?>
                <?php if(!empty($caption)){ ?>
                    <span class="eltdf-workflow-caption"><?php echo esc_attr($caption) ?></span>
                <?php } ?>
                <?php if(!empty($title)){ ?>
                    <h2><?php echo esc_attr($title) ?></h2>
                <?php } ?>
                <?php if(!empty($text)){ ?>
                    <span class="text"><?php echo wp_kses( $text, array( 'br' => true, 'a' => array( 'href' => true ) ) ); ?></span>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
