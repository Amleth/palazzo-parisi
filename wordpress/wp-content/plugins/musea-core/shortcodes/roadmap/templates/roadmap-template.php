<div class="eltdf-roadmap <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-roadmap-line">

        <span class="eltdf-rl-arrow-left">
            <i class="eltdf-icon-font-awesome fa fa-angle-left"></i>
        </span>

        <span class="eltdf-rl-arrow-right">
            <i class="eltdf-icon-font-awesome fa fa-angle-right"></i>
        </span>
    </div>
<!--    <div class="eltdf-roadmap-holder">-->
        <?php if (is_array($stage) && count($stage)) { ?>
            <div class="eltdf-roadmap-inner-holder clearfix">
            <?php foreach($stage as $key => $stage_item) {
                $stage_item['number'] = $key;
                $additional = $this_object->getItemAdditional($stage_item);
                $item_classes = $additional['classes'];
                $item_style = $additional['style'];
                ?>
                <div <?php musea_elated_class_attribute($item_classes);?>>
                    <div class="eltdf-roadmap-item-circle-holder">
                        <div class="eltdf-roadmap-item-before-circle"></div>
                        <div class="eltdf-roadmap-item-circle"></div>
                        <div class="eltdf-roadmap-item-after-circle"></div>
                    </div>
                    <div class="eltdf-roadmap-item-stage-title-holder">
                        <span class="eltdf-ris-title">
                            <?php echo esc_html($stage_item['stage_title'])?>
                        </span>
                    </div>
                    <div class="eltdf-roadmap-item-content-holder" <?php musea_elated_inline_style($item_style);?>>
                        <h5 class="eltdf-ric-title">
                            <?php echo esc_html($stage_item['info_title'])?>
                        </h5>
                        <div class="eltdf-ric-content">
                            <?php echo esc_html($stage_item['info_text'])?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
<!--    </div>-->
</div>