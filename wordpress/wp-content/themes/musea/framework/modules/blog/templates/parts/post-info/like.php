<?php if( musea_elated_is_plugin_installed( 'core' ) ) { ?>
    <div class="eltdf-blog-like">
        <?php if( function_exists('musea_core_get_like') ) musea_core_get_like(); ?>
    </div>
<?php } ?>