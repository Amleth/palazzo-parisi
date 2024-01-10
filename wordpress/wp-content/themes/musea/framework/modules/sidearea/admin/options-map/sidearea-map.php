<?php

if ( ! function_exists( 'musea_elated_sidearea_options_map' ) ) {
	function musea_elated_sidearea_options_map() {

        musea_elated_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'musea'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = musea_elated_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'musea'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'musea'),
                'description'   => esc_html__('Choose a type of Side Area', 'musea'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'musea'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'musea'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'musea'),
                ),
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'musea'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'musea'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = musea_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'musea'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'musea'),
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'musea'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'musea'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'icon_pack',
                'label'         => esc_html__('Select Side Area Icon Source', 'musea'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'musea'),
                'options'       => musea_elated_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = musea_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'musea'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'musea'),
                'options'       => musea_elated_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = musea_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'musea'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'musea'),
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'musea'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'musea'),
            )
        );

        $side_area_icon_style_group = musea_elated_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'musea'),
                'description' => esc_html__('Define styles for Side Area icon', 'musea')
            )
        );

        $side_area_icon_style_row1 = musea_elated_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'musea')
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'musea')
            )
        );

        $side_area_icon_style_row2 = musea_elated_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'musea')
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'musea')
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'musea'),
                'description' => esc_html__('Choose a background color for Side Area', 'musea')
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'musea'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'musea'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        musea_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'musea'),
                'description'   => esc_html__('Choose text alignment for side area', 'musea'),
                'options'       => array(
                    ''       => esc_html__('Default', 'musea'),
                    'left'   => esc_html__('Left', 'musea'),
                    'center' => esc_html__('Center', 'musea'),
                    'right'  => esc_html__('Right', 'musea')
                )
            )
        );
    }

    add_action('musea_elated_action_options_map', 'musea_elated_sidearea_options_map', musea_elated_set_options_map_position( 'sidearea' ) );
}