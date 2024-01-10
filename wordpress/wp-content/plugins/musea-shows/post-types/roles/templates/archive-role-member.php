<?php
get_header();
musea_elated_get_title();
do_action('musea_elated_action_before_main_content'); ?>
<div class="eltdf-container eltdf-default-page-template">
	<?php do_action('musea_elated_action_after_container_open'); ?>
	<div class="eltdf-container-inner clearfix">
		<?php
			$musea_taxonomy_id = get_queried_object_id();
			$musea_taxonomy = !empty($musea_taxonomy_id) ? get_term_by( 'term_taxonomy_id', $musea_taxonomy_id, 'roles-category' ) : '';
			$musea_taxonomy_slug = !empty($musea_taxonomy) ? $musea_taxonomy->slug : '';

            musea_shows_get_roles_category_list($musea_taxonomy_slug);
		?>
	</div>
	<?php do_action('musea_elated_action_before_container_close'); ?>
</div>
<?php get_footer(); ?>
