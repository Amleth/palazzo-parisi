<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class ElatedSkin extends MuseaElatedClassSkinAbstract {
	
    /**
     * Skin constructor. Hooks to musea_elated_admin_scripts_init and musea_elated_enqueue_admin_styles
     */
	public function __construct() {
		$this->skinName = 'elated';
		
		// Admin register scripts and styles
		add_action( 'musea_elated_action_admin_scripts_init', array( $this, 'registerStyles' ) );
		add_action( 'musea_elated_action_admin_scripts_init', array( $this, 'registerScripts' ) );
		
		// Admin enqueue scripts and styles
		add_action( 'musea_elated_action_enqueue_admin_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'musea_elated_action_enqueue_admin_scripts', array( $this, 'enqueueScripts' ) );
		
		// Admin enqueue meta box scripts and styles
		add_action( 'musea_elated_action_enqueue_meta_box_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'musea_elated_action_enqueue_meta_box_scripts', array( $this, 'enqueueScripts' ) );
		
		// Change options map order for this skin
		add_filter( 'musea_elated_filter_options_map_position', array( $this, 'setOptionsMapPosition' ), 10, 2 );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'setShortcodeJSParams' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have
	}

    /**
     * Method that registers skin scripts
     */
	public function registerScripts() {
		
		$this->scripts['eltdf-ui-admin-skin'] = array(
			'path'       => 'assets/js/eltdf-ui.js',
			'dependency' => array()
		);
		
		foreach ( $this->scripts as $scriptHandle => $script ) {
			musea_elated_register_skin_script( $scriptHandle, $script['path'], $script['dependency'] );
		}
	}

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
	    $this->styles['eltdf-bootstrap'] = 'assets/css/eltdf-bootstrap.css';
        $this->styles['eltdf-page-admin'] = 'assets/css/eltdf-page.css';
        $this->styles['eltdf-options-admin'] = 'assets/css/eltdf-options.css';
        $this->styles['eltdf-meta-boxes-admin'] = 'assets/css/eltdf-meta-boxes.css';
        $this->styles['eltdf-ui-admin'] = 'assets/css/eltdf-ui/eltdf-ui.css';
        $this->styles['eltdf-forms-admin'] = 'assets/css/eltdf-forms.css';
        $this->styles['eltdf-import'] = 'assets/css/eltdf-import.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
	        musea_elated_register_skin_style($styleHandle, $stylePath);
        }
    }

    /**
     * Method that renders options page
     *
     * @see ElatedSkin::getHeader()
     * @see ElatedSkin::getPageNav()
     * @see ElatedSkin::getPageContent()
     */
    public function renderOptions() {
        global $musea_elated_global_Framework;
        $tab    = musea_elated_get_admin_tab();
        $active_page = $musea_elated_global_Framework->eltdOptions->getAdminPageFromSlug($tab);
        if ($active_page == null) return;
        ?>
        <div class="eltdf-options-page eltdf-page">
            <?php $this->getHeader($active_page); ?>
            <div class="eltdf-page-content-wrapper">
                <div class="eltdf-page-content">
                    <div class="eltdf-page-navigation eltdf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    /**
     * Method that renders header of options page.
     * @param bool $show_save_btn whether to show save button. Should be hidden on import page
     *
     * @see MuseaElatedClassSkinAbstract::loadTemplatePart()
     */
    public function getHeader($activePage = '', $show_save_btn = true) {
        $this->loadTemplatePart('header', array('active_page' => $activePage, 'show_save_btn' => $show_save_btn));
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $is_import_page if is import page highlighted that tab
     *
     * @see MuseaElatedClassSkinAbstract::loadTemplatePart()
     */
    public function getPageNav($tab, $is_import_page = false, $is_backup_options_page = false) {
        $this->loadTemplatePart('navigation', array(
            'tab' => $tab,
            'is_import_page' => $is_import_page,
			'is_backup_options_page' => $is_backup_options_page
        ));
    }
	
	/**
	 * Method that loads current page content
	 *
	 * @param MuseaElatedClassAdminPage $page current page to load
	 * @see MuseaElatedClassSkinAbstract::loadTemplatePart()
	 */
    public function getPageContent($page) {
        $this->loadTemplatePart('content', array('page' => $page));
    }

    /**
     * Method that loads content for import page
     */
    public function getImportContent() {
        $this->loadTemplatePart('content-import');
    }
	
	/**
	 * Method that loads content for backup page
	 */
	public function getBackupOptionsContent() {
		$this->loadTemplatePart('backup-options');
	}

    /**
     * Method that loads anchors and save button template part
     *
     * @param MuseaElatedClassAdminPage $page current page to load
     * @see ElatedSkinAbstract::loadTemplatePart()
     */
    public function getAnchors($page) {
        $this->loadTemplatePart('anchors', array('page' => $page));
    }

    /**
     * Method that renders import page
     *
     *  @see ElatedSkin::getHeader()
     *  @see ElatedSkin::getPageNav()
     *  @see ElatedSkin::getImportContent()
     */
    public function renderImport() { ?>
        <div class="eltdf-options-page eltdf-page">
            <?php $this->getHeader('', false); ?>
            <div class="eltdf-page-content-wrapper">
                <div class="eltdf-page-content">
                    <div class="eltdf-page-navigation eltdf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

	/**
	 * Method that renders backup options page
	 *
	 * @see ElatedSkin::getHeader()
	 * * @see ElatedSkin::getPageNav()
	 * * @see ElatedSkin::getImportContent()
	 */
	public function renderBackupOptions() { ?>
		<div class="eltdf-options-page eltdf-page">
			<?php $this->getHeader('',false); ?>
			<div class="eltdf-page-content-wrapper">
				<div class="eltdf-page-content">
					<div class="eltdf-page-navigation eltdf-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('backup_options', false, true); ?>
						<?php $this->getBackupOptionsContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
	
	function setOptionsMapPosition( $position, $map ) {
		
		switch ( $map ) {
			case 'header':
				$position = 3;
				break;
			case 'title':
				$position = 4;
				break;
			case 'page':
				$position = 5;
				break;
			case 'sidebar':
				$position = 6;
				break;
			case 'search':
				$position = 7;
				break;
			case 'sidearea':
				$position = 8;
				break;
			case 'fonts':
				$position = 10;
				break;
			case 'blog':
				$position = 11;
				break;
			case 'portfolio':
				$position = 12;
				break;
			case 'proofing-gallery':
				$position = 12;
				break;
			case 'stock-photography':
				$position = 12;
				break;
		}
		
		return $position;
	}
}
?>