<?php if($max_num_pages > 1) { ?>
	<div class="eltdf-blog-pag-loading">
		<div class="eltdf-blog-pag-bounce1"></div>
		<div class="eltdf-blog-pag-bounce2"></div>
		<div class="eltdf-blog-pag-bounce3"></div>
	</div>
<?php
	$unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'eltdf_blog_load_more_nonce_' . $unique_id, 'eltdf_blog_load_more_nonce_' . $unique_id );
}