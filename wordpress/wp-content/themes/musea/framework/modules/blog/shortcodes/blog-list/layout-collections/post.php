<li class="eltdf-bl-item eltdf-item-space">
	<div class="eltdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			musea_elated_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="eltdf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="eltdf-bli-info" <?php echo musea_elated_get_inline_style( $params['title_background_color'] ); ?>>
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                musea_elated_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                musea_elated_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                musea_elated_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                musea_elated_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                musea_elated_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                musea_elated_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	        <div class="eltdf-bli-title" <?php echo musea_elated_get_inline_style( $params['title_background_color'] ); ?>>
	            <?php musea_elated_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
            </div>
	        <div class="eltdf-bli-excerpt">
		        <?php musea_elated_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
		        <?php musea_elated_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
	        </div>
        </div>
	</div>
</li>