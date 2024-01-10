<?php do_action( 'musea_elated_action_before_footer_content' ); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="eltdf-page-footer <?php echo esc_attr($holder_classes); ?>">
				<?php
					if($display_footer_top) {
						musea_elated_get_footer_top();
					}
					if($display_footer_bottom) {
						musea_elated_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.eltdf-wrapper-inner  -->
</div> <!-- close div.eltdf-wrapper -->
<?php
/**
 * musea_elated_action_before_closing_body_tag hook
 *
 * @see musea_elated_get_side_area() - hooked with 10
 * @see musea_elated_smooth_page_transitions() - hooked with 10
 */
do_action( 'musea_elated_action_before_closing_body_tag' ); ?>
<?php wp_footer(); ?>
</body>
</html>