<div class="eltdf-fullscreen-menu-holder-outer">
	<div class="eltdf-fullscreen-menu-holder">
		<div class="eltdf-fullscreen-menu-holder-inner">
			<div class="eltdf-fullscreen-menu-cover"></div>
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="eltdf-container-inner">
			<?php endif; ?>
			
			<?php 
			//Navigation
			musea_elated_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal');;

			?>
			
			<?php if ( musea_elated_is_header_widget_area_active( 'two' ) ) { ?>
				<div class="eltdf-fullscreen-below-menu-widget-holder">
					<?php musea_elated_get_header_widget_area_two(); ?>
				</div>
			<?php } ?>
			
			<?php if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>