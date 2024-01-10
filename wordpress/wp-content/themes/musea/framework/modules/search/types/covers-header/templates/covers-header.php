<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="eltdf-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="eltdf-container">
		<div class="eltdf-container-inner clearfix">
	<?php } ?>
			<div class="eltdf-form-holder-outer">
				<div class="eltdf-form-holder">
					<div class="eltdf-form-holder-inner">
						<input type="text" placeholder="<?php esc_attr_e( 'Search', 'musea' ); ?>" name="s" class="eltdf_search_field" autocomplete="off" required />
						<a <?php musea_elated_class_attribute( $search_close_icon_class ); ?> href="#">
							<?php echo musea_elated_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
						</a>
					</div>
				</div>
			</div>
	<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>