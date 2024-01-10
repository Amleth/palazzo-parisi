<?php

//define constants
define( 'MUSEA_ELATED_ROOT', get_template_directory_uri() );
define( 'MUSEA_ELATED_ROOT_DIR', get_template_directory() );
define( 'MUSEA_ELATED_ASSETS_ROOT', MUSEA_ELATED_ROOT . '/assets' );
define( 'MUSEA_ELATED_ASSETS_ROOT_DIR', MUSEA_ELATED_ROOT_DIR . '/assets' );
define( 'MUSEA_ELATED_FRAMEWORK_ROOT', MUSEA_ELATED_ROOT . '/framework' );
define( 'MUSEA_ELATED_FRAMEWORK_ROOT_DIR', MUSEA_ELATED_ROOT_DIR . '/framework' );
define( 'MUSEA_ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT', MUSEA_ELATED_ROOT . '/framework/admin/assets' );
define( 'MUSEA_ELATED_FRAMEWORK_ICONS_ROOT', MUSEA_ELATED_ROOT . '/framework/lib/icons-pack' );
define( 'MUSEA_ELATED_FRAMEWORK_ICONS_ROOT_DIR', MUSEA_ELATED_ROOT_DIR . '/framework/lib/icons-pack' );
define( 'MUSEA_ELATED_FRAMEWORK_MODULES_ROOT', MUSEA_ELATED_ROOT . '/framework/modules' );
define( 'MUSEA_ELATED_FRAMEWORK_MODULES_ROOT_DIR', MUSEA_ELATED_ROOT_DIR . '/framework/modules' );
define( 'MUSEA_ELATED_FRAMEWORK_HEADER_ROOT', MUSEA_ELATED_ROOT . '/framework/modules/header' );
define( 'MUSEA_ELATED_FRAMEWORK_HEADER_ROOT_DIR', MUSEA_ELATED_ROOT_DIR . '/framework/modules/header' );
define( 'MUSEA_ELATED_FRAMEWORK_HEADER_TYPES_ROOT', MUSEA_ELATED_ROOT . '/framework/modules/header/types' );
define( 'MUSEA_ELATED_FRAMEWORK_HEADER_TYPES_ROOT_DIR', MUSEA_ELATED_ROOT_DIR . '/framework/modules/header/types' );
define( 'MUSEA_ELATED_FRAMEWORK_SEARCH_ROOT', MUSEA_ELATED_ROOT . '/framework/modules/search' );
define( 'MUSEA_ELATED_FRAMEWORK_SEARCH_ROOT_DIR', MUSEA_ELATED_ROOT_DIR . '/framework/modules/search' );
define( 'MUSEA_ELATED_THEME_ENV', 'false' );
define( 'MUSEA_ELATED_PROFILE_SLUG', 'elated' );
define( 'MUSEA_ELATED_OPTIONS_SLUG', 'musea_elated_theme_menu');

//include necessary files
include_once MUSEA_ELATED_ROOT_DIR . '/framework/eltdf-framework.php';
include_once MUSEA_ELATED_ROOT_DIR . '/includes/nav-menu/eltdf-menu.php';
require_once MUSEA_ELATED_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once MUSEA_ELATED_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once MUSEA_ELATED_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once MUSEA_ELATED_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( MUSEA_ELATED_ROOT_DIR . '/export' ) ) {
	include_once MUSEA_ELATED_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once MUSEA_ELATED_ROOT_DIR . '/includes/eltdf-body-class-functions.php';
	include_once MUSEA_ELATED_ROOT_DIR . '/includes/eltdf-loading-spinners.php';
}