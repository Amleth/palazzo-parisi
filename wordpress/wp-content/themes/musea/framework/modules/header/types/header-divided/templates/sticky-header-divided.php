<?php do_action('musea_elated_action_before_sticky_header'); ?>

    <div class="eltdf-sticky-header">

        <?php do_action('musea_elated_action_after_sticky_menu_html_open'); ?>
        <div class="eltdf-sticky-holder">
            <?php if ($sticky_header_in_grid) : ?>
            <div class="eltdf-grid">
                <?php endif; ?>
                <div class="eltdf-vertical-align-containers">
                    <div class="eltdf-position-left"><!--
                     --><div class="eltdf-position-left-inner">
                            <?php musea_elated_get_sticky_divided_left_main_menu('eltdf-sticky-nav'); ?>
                        </div>
                    </div>
                    <div class="eltdf-position-center"><!--
                     --><div class="eltdf-position-center-inner">
                            <?php if (!$hide_logo) {
                                musea_elated_get_logo('sticky');
                            } ?>
                        </div>
                    </div>
                    <div class="eltdf-position-right"><!--
                     --><div class="eltdf-position-right-inner">
                            <?php musea_elated_get_sticky_divided_right_main_menu('eltdf-sticky-nav'); ?>
                        </div>
                    </div>
                </div>
                <?php if ($sticky_header_in_grid) : ?>
            </div>
        <?php endif; ?>
        </div>
    </div>

<?php do_action('musea_elated_action_after_sticky_header'); ?>