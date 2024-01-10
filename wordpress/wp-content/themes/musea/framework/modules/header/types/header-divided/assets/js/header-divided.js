(function($) {
    "use strict";

    var headerDivided = {};
    eltdf.modules.headerDivided = headerDivided;
	
	headerDivided.eltdfOnDocumentReady = eltdfOnDocumentReady;
	headerDivided.eltdfOnWindowResize = eltdfOnWindowResize;

    $(document).ready(eltdfOnDocumentReady);
    $(window).resize(eltdfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
        eltdfInitDividedHeaderMenu();
    }

    /**
     * Init Divided Header Menu
     */
    function eltdfInitDividedHeaderMenu(){
        if(eltdf.body.hasClass('eltdf-header-divided')){
	        //get left side menu width
	        var menuArea = $('.eltdf-menu-area, .eltdf-sticky-header'),
		        menuAreaWidth = menuArea.width(),
		        menuAreaSidePadding = parseInt(menuArea.find('.eltdf-vertical-align-containers').css('paddingLeft'), 10),
		        menuAreaItem = $('.eltdf-main-menu > ul > li > a'),
		        menuItemPadding = 0,
		        logoArea = menuArea.find('.eltdf-logo-wrapper .eltdf-normal-logo'),
		        logoAreaWidth = 0;
	
	        menuArea.waitForImages(function() {
	        	
		        if(menuArea.find('.eltdf-grid').length) {
			        menuAreaWidth = menuArea.find('.eltdf-grid').outerWidth();
		        }
		
		        if(menuAreaItem.length) {
			        menuItemPadding = parseInt(menuAreaItem.css('paddingLeft'), 10);
		        }
		
		        if(logoArea.length) {
			        logoAreaWidth = logoArea.width() / 2;
		        }
		
		        var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth - menuAreaSidePadding);
		
		        menuArea.find('.eltdf-position-left').width(menuAreaLeftRightSideWidth);
		        menuArea.find('.eltdf-position-right').width(menuAreaLeftRightSideWidth);
		
		        menuArea.css('opacity',1);
		
		        if (typeof eltdf.modules.header.eltdfSetDropDownMenuPosition === "function") {
			        eltdf.modules.header.eltdfSetDropDownMenuPosition();
		        }
		        if (typeof eltdf.modules.header.eltdfSetDropDownWideMenuPosition === "function") {
			        eltdf.modules.header.eltdfSetDropDownWideMenuPosition();
		        }
	        });
        }
    }

})(jQuery);