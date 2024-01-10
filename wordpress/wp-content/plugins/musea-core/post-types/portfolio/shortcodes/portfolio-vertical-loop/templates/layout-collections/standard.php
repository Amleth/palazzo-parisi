<div class="eltdf-pvli-content-holder">
    <div class="eltdf-pvli-background-text">
        <?php echo esc_html__( 'Next', 'musea-core' ); ?>
    </div>
    <div class="eltdf-pvli-image-holder">
        <div class="eltdf-pvli-image-inner">
            <?php echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/image', 'standard', $params); ?>
            <div class="eltdf-pvli-image-title">
                <div class="eltdf-pvli-image-title-inner">
                    <div class="eltdf-pvli-info">
                        <?php echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/category', 'standard', $params); ?>
                    </div>
                    <?php echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/title', 'standard', $params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="eltdf-pvli-text">
        <div class="eltdf-pvli-text-inner">
            <?php echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/title', 'standard', $params); ?>
            <div class="eltdf-pvli-info">
                <?php echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/category', 'standard', $params); ?>
            </div>
            <div class="eltdf-container">
                <div class="eltdf-container-inner clearfix">
                    <div class="eltdf-grid-row">
                        <div class="eltdf-grid-col-10">
                            <?php echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/excerpt', 'standard', $params); ?>
                            <?php
                            //get portfolio tags section
                            echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/tags', 'standard', $params); ?>
                        </div>
                        <div class="eltdf-grid-col-2">
                            <div class="eltdf-pvl-info-holder">
                                <?php
                                //get portfolio custom fields section
                                echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/custom-fields', 'standard', $params);

                                //get portfolio categories section
                                echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/content-categories', 'standard', $params);

                                //get portfolio date section
                                echo musea_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/date', 'standard', $params);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="eltdf-full-width">
                <div class="eltdf-full-width-inner">
                    <?php the_content();?>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="eltdf-pvli-content-link"></a>
</div>