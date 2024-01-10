<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-info-top">
                </div>
                <div class="eltdf-post-text-main">
                    <div class="eltdf-post-mark">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="24.615px" height="18.233px" viewBox="0 0 24.615 18.233" enable-background="new 0 0 24.615 18.233" xml:space="preserve">
                        <g>
                            <path fill="#4E4E4E" d="M19.542,0.007c-1.33,0.165-1.92,0.869-3,3.15v0.75c0,0,3.899,1.604,4.283,4.476
                                c0.383,2.862-0.953,6.567-7.658,8.499v1.352c0,0,7.399-1.41,10.342-7.426C27.035,3.596,21.148-0.192,19.542,0.007z"/>
                            <path fill="#4E4E4E" d="M6.375,0.007c-1.33,0.165-1.92,0.869-3,3.15v0.75c0,0,3.899,1.604,4.283,4.476
                                C8.041,11.245,6.705,14.95,0,16.882v1.352c0,0,7.399-1.41,10.342-7.426C13.868,3.596,7.981-0.192,6.375,0.007z"/>
                        </g>
                        </svg>
                    </div>
                    <?php musea_elated_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="eltdf-post-additional-content">
        <?php the_content(); ?>
        <div class="eltdf-post-info-bottom clearfix">
            <div class="eltdf-post-info-bottom-left">
                <?php musea_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
            </div>
            <div class="eltdf-post-info-bottom-right">
                <?php musea_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
            </div>
        </div>
    </div>
</article>