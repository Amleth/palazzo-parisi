<?php
get_header();
musea_elated_get_title();
do_action( 'musea_elated_action_before_main_content' ); ?>
<div class="eltdf-container eltdf-default-page-template">
	<?php do_action( 'musea_elated_action_after_container_open' ); ?>
	<div class="eltdf-container-inner clearfix">
		<?php
			$musea_taxonomy_id   = get_queried_object_id();
			$musea_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$musea_taxonomy      = ! empty( $musea_taxonomy_id ) ? get_term_by( 'id', $musea_taxonomy_id, $musea_taxonomy_type ) : '';
			$musea_taxonomy_slug = ! empty( $musea_taxonomy ) ? $musea_taxonomy->slug : '';
			$musea_taxonomy_name = ! empty( $musea_taxonomy ) ? $musea_taxonomy->taxonomy : '';
			
			musea_core_get_archive_portfolio_list( $musea_taxonomy_slug, $musea_taxonomy_name );
		?>
	</div>
	<?php do_action( 'musea_elated_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
