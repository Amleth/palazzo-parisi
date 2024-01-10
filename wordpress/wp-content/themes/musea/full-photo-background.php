<?php
/*
Template Name: Full Photo Background
*/
?>
<?php
$eltdf_sidebar_layout  = musea_elated_sidebar_layout();
$eltdf_grid_space_meta = musea_elated_get_meta_field_intersect( 'page_grid_space' );
$eltdf_holder_classes  = ! empty( $eltdf_grid_space_meta ) ? 'eltdf-grid-' . $eltdf_grid_space_meta . '-gutter' : '';

get_header();

$caption = get_post_meta(get_the_ID(), 'eltdf_title_area_caption_meta');
$caption = ! empty($caption) ? $caption[0] : '';

$text = get_post_meta(get_the_ID(), 'eltdf_title_area_subtitle_meta');
$text = ! empty($text) ? $text[0] : '';

$caption_color = get_post_meta(get_the_ID(), 'eltdf_caption_color_meta');
$caption_color = ! empty($caption_color) ? $caption_color[0] : '#fff';

$title_color = get_post_meta(get_the_ID(), 'eltdf_title_text_color_meta');
$title_color = ! empty($title_color) ? $title_color[0] : '#fff';

$text_color = get_post_meta(get_the_ID(), 'eltdf_subtitle_color_meta');
$text_color = ! empty($text_color) ? $text_color[0] : '#fff';

$title_tag = get_post_meta(get_the_ID(), 'eltdf_title_area_title_tag_meta');
$title_tag = ! empty($title_tag) ? $title_tag[0] : 'h1';

$text_tag = get_post_meta(get_the_ID(), 'eltdf_title_area_subtitle_tag_meta');
$text_tag = ! empty($text_tag) ? $text_tag[0] : 'p';

?>
<div class="eltdf-fpb-template-section-title">
    <?php   echo musea_elated_execute_shortcode('eltdf_section_title', array (
        'title'               => get_the_title(get_the_ID()),
        'caption'             => $caption,
        'text'                => $text,
        'position'            => 'center',
        'title_tag'           => $title_tag,
        'text_tag'            => $text_tag,
        'caption_color'       => $caption_color,
        'title_color'         => $title_color,
        'text_color'          => $text_color
    )); ?>
</div>
<?php
get_template_part( 'slider' );
do_action('musea_elated_action_before_main_content');
?>

<div class="eltdf-container eltdf-default-page-template">
    <?php do_action( 'musea_elated_action_after_container_open' ); ?>

    <div class="eltdf-container-inner clearfix">
        <?php do_action( 'musea_elated_action_after_container_inner_open' ); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="eltdf-grid-row <?php echo esc_attr( $eltdf_holder_classes ); ?>">
                <div <?php echo musea_elated_get_content_sidebar_class(); ?>>
                    <?php
                    the_content();
                    do_action( 'musea_elated_action_page_after_content' );
                    ?>
                </div>
                <?php if ( $eltdf_sidebar_layout !== 'no-sidebar' ) { ?>
                    <div <?php echo musea_elated_get_sidebar_holder_class(); ?>>
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div>
        <?php endwhile; endif; ?>
        <?php do_action( 'musea_elated_action_before_container_inner_close' ); ?>
    </div>

    <?php do_action( 'musea_elated_action_before_container_close' ); ?>
</div>

<?php get_footer(); ?>
