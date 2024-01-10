<div class="eltdf-container">
	<div class="eltdf-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if(post_password_required()) {
				echo get_the_password_form();
			} else { ?>
				<div class="eltdf-role-single-holder">
					<div class="eltdf-grid-row">
                        <h2 class="eltdf-rs-title"><?php the_title(); ?></h2>
                        <h6 class="eltdf-rs-position"> <?php echo esc_html($position); ?> </h6>
					</div>
                    <div class="eltdf-rs-main-info">
                        <div class="eltdf-role-info">
                            <?php
                            //load team info
                            musea_shows_get_cpt_single_module_template_part('templates/single/parts/image', 'roles', '', $params);
                            musea_shows_get_cpt_single_module_template_part('templates/single/parts/performances', 'roles', '', $params);
                            ?>
                        </div>
                        <div class="eltdf-role-single-content">
                            <?php
                            //load content
                            musea_shows_get_cpt_single_module_template_part('templates/single/parts/content', 'roles', '', $params);
                            ?>
                        </div>
                    </div>
				</div>
			<?php } ?>
		<?php endwhile;	endif; ?>
	</div>
</div>