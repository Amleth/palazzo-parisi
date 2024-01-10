(function($) {
    'use strict';

    var woocommerce = {};
    eltdf.modules.woocommerce = woocommerce;

    woocommerce.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfInitQuantityButtons();
        eltdfInitSelect2();
	    eltdfInitSingleProductLightbox();
        eltdfBottomLineFortabs();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function eltdfInitQuantityButtons() {
		$(document).on('click', '.eltdf-quantity-minus, .eltdf-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.eltdf-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				min = parseFloat(inputField.data('min')),
				minus = false,
				inputValue = typeof Number.isNaN === 'function' && Number.isNaN(parseFloat(inputField.val())) ? min : parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('eltdf-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= min) {
					inputField.val(newInputValue);
				} else {
					inputField.val(min);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}
    function eltdfBottomLineFortabs() {
        var firstLevelMenus = $('.woocommerce-tabs > ul');

        if (firstLevelMenus.length) {
            firstLevelMenus.each(function(){
                var mainMenu = $(this);

                mainMenu.append('<li class="eltdf-product-tabs-line"></li>');

                var menuLine = mainMenu.find('.eltdf-product-tabs-line'),
                    menuItems = mainMenu.find('> li:not(.eltdf-product-tabs-line)'),
                    initialOffset;

                if (menuItems.filter('.active').length) {
                    initialOffset = menuItems.filter('.active').offset().left;
                    menuLine.css('width', menuItems.filter('.active').outerWidth());
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

                    if(menuItem.hasClass('active')){
                        menuLine.css('width', menuItemWidth);
                        menuLine.css('left', menuItemOffset);
                    } else{
                        var activeLi = menuItems.filter('.active'),
                            activeWidth = activeLi.outerWidth(),
                            activeLeft = activeLi.offset().left - mainMenuOffset;

                        menuLine.css('width', activeWidth);
                        menuLine.css('left', activeLeft);
                    }
                });

            });
        }
    }
    /*
    ** Init select2 script for select html dropdowns
    */
	function eltdfInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.eltdf-woocommerce-page .eltdf-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
		
		var defaultMonsterWidgets = $('.widget.widget_archive select, .widget.widget_categories select, .widget.widget_text select');
		if (defaultMonsterWidgets.length && typeof defaultMonsterWidgets.select2 === 'function') {
			defaultMonsterWidgets.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function eltdfInitSingleProductLightbox() {
		var item = $('.eltdf-woo-single-page.eltdf-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof eltdf.modules.common.eltdfPrettyPhoto === "function") {
				eltdf.modules.common.eltdfPrettyPhoto();
			}
		}
	}

})(jQuery);