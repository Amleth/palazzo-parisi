<?php do_action('musea_elated_action_before_page_header'); ?>

<header class="eltdf-page-header">
	<?php do_action('musea_elated_action_after_page_header_html_open'); ?>
	
    <?php if($show_fixed_wrapper) : ?>
        <div class="eltdf-fixed-wrapper">
    <?php endif; ?>
	        
    <div class="eltdf-menu-area">
	    <?php do_action('musea_elated_action_after_header_menu_area_html_open'); ?>
	    
        <?php if($menu_area_in_grid) : ?>
            <div class="eltdf-grid">
        <?php endif; ?>
	            
        <div class="eltdf-vertical-align-containers">
            <div class="eltdf-position-left"><!--
             --><div class="eltdf-divided-left-widget-area">
                    <div class="eltdf-divided-left-widget-area-inner">
	                    <div class="eltdf-position-left-inner-wrap">
                            <?php musea_elated_get_header_widget_area_one(); ?>
	                    </div>
	                </div>
	            </div>
	            <div class="eltdf-position-left-inner">
                    <?php musea_elated_get_divided_left_main_menu(); ?>
                </div>
            </div>
            <div class="eltdf-position-center"><!--
             --><div class="eltdf-position-center-inner">
                    <?php if(!$hide_logo) {
                        musea_elated_get_logo();
                    } ?>
                </div>
            </div>
            <div class="eltdf-position-right"><!--
             --><div class="eltdf-position-right-inner">
                    <?php musea_elated_get_divided_right_main_menu(); ?>
                </div>
	            <div class="eltdf-divided-right-widget-area">
		            <div class="eltdf-divided-right-widget-area-inner">
			            <div class="eltdf-position-right-inner-wrap">
				            <?php musea_elated_get_header_widget_area_two(); ?>
			            </div>
		            </div>
	            </div>
            </div>
        </div>
	            
        <?php if($menu_area_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
	
    <?php if ( $show_fixed_wrapper ) { ?>
        </div>
	<?php } ?>
	
	<?php if ( $show_sticky ) {
		musea_elated_get_sticky_header( 'divided', 'header/types/header-divided' );
	} ?>
	
	<?php do_action('musea_elated_action_before_page_header_html_close'); ?>
</header>

<?php do_action('musea_elated_action_after_page_header'); ?>