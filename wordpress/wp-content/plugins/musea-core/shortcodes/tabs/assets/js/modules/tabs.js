(function($) {
	'use strict';
	
	var tabs = {};
	eltdf.modules.tabs = tabs;
	
	tabs.eltdfInitTabs = eltdfInitTabs;
	
	
	tabs.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitTabs();
        eltdfBottomLineFortabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function eltdfInitTabs(){
		var tabs = $('.eltdf-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.eltdf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.eltdf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.eltdf-tabs a.eltdf-external-link').unbind('click');
			});
		}
	}

    function eltdfBottomLineFortabs() {
        var firstLevelMenus = $('.eltdf-tabs-standard .eltdf-tabs-nav');

        if (firstLevelMenus.length) {
            firstLevelMenus.each(function(){
                var mainMenu = $(this);

                mainMenu.append('<li class="eltdf-tabs-line"></li>');

                var menuLine = mainMenu.find('.eltdf-tabs-line'),
                    menuItems = mainMenu.find('> li:not(.eltdf-tabs-line)'),
                    initialOffset;

                if (menuItems.filter('.ui-state-active').length) {
                    initialOffset = menuItems.filter('.ui-state-active').offset().left;
                    menuLine.css('width', menuItems.filter('.ui-state-active').outerWidth());
                } else {
                    initialOffset = menuItems.first().offset().left;
                    menuLine.css('width', menuItems.first().outerWidth());
                }

                //initial positioning
                menuLine.css('left',  initialOffset - mainMenu.offset().left);
                //menuLine.css('top',  Math.floor(menuItems.first().find('.item_text').offset().top - mainMenu.offset().top + menuItems.first().find('.item_text').height() + lineTopOffset));

                //fx on
                menuItems.mouseenter(function(){
                    var menuItem = $(this),
                        menuItemWidth = menuItem.outerWidth(),
                        mainMenuOffset = mainMenu.offset().left,
                        menuItemOffset = menuItem.offset().left - mainMenuOffset;

                    menuLine.css('width', menuItemWidth);
                    menuLine.css('left', menuItemOffset);
                });

                //fx off
                menuItems.mouseleave(function(){

                    var menuItem = $(this),
                        menuItemWidth = menuItem.outerWidth(),
                        mainMenuOffset = mainMenu.offset().left,
                        menuItemOffset = menuItem.offset().left - mainMenuOffset;

                    if(menuItem.hasClass('ui-state-active')){
                        menuLine.css('width', menuItemWidth);
                        menuLine.css('left', menuItemOffset);
                    } else{
                        var activeLi = menuItems.filter('.ui-state-active'),
                            activeWidth = activeLi.outerWidth(),
                            activeLeft = activeLi.offset().left - mainMenuOffset;

                        menuLine.css('width', activeWidth);
                        menuLine.css('left', activeLeft);
                    }
                });

            });
        }
    }
	
})(jQuery);