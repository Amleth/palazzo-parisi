<?php

musea_elated_get_single_post_format_html( $blog_single_type );

do_action( 'musea_elated_action_after_article_content' );

musea_elated_get_module_template_part( 'templates/parts/single/related-posts', 'blog' );

musea_elated_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

musea_elated_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

musea_elated_get_module_template_part( 'templates/parts/single/comments', 'blog' );
