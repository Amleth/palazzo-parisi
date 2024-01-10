(function($) {
	'use strict';
	
	var button = {};
	eltdf.modules.button = button;
	
	button.eltdfButton = eltdfButton;
	
	
	button.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var eltdfButton = function() {
		//all buttons on the page
		var buttons = $('.eltdf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};

		// var buttonHoverBehavior = function(button) {
		// 	button.on('mouseenter', function() {
		// 		if (!button.hasClass('eltdf-btn-hovered')) {
		// 			var thisButton = $(this);
		// 			thisButton.addClass('eltdf-btn-hovered');
		// 			setTimeout(function() {
		// 				thisButton.removeClass('eltdf-btn-hovered');
		// 			}, 800);
		// 		}
		// 	})
		// }
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};

		var buttonTypeOutlineSlit = function(button) {
			
			if(button.hasClass('eltdf-btn-outline-slit')) {
				var buttonWidth = button.outerWidth(),
					buttonHeight = button.outerHeight(),
					borderColor = button.data('border-color');

				button.prepend('<svg height="'+ buttonHeight +'" width="'+ buttonWidth +'"><rect height="'+ buttonHeight +'" width="'+ buttonWidth +'"/></svg>');
				button.find('svg rect').css('stroke', borderColor);
			}
		};


		var buttonTypeOtherOutlineSlit = function(button) {

			button.addClass('eltdf-btn eltdf-btn-outline-slit');
			
			var buttonWidth = button.outerWidth(),
					buttonHeight = button.outerHeight(),
					borderColor = button.data('border-color');

			button.prepend('<svg height="'+ buttonHeight +'" width="'+ buttonWidth +'"><rect height="'+ buttonHeight +'" width="'+ buttonWidth +'"/></svg>');
			button.find('svg rect').css('stroke', borderColor);
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
						buttonTypeOutlineSlit($(this));
					});
				}

				$(window).on('load', function() {
					var otherButtons = $('.product .added_to_cart, .product .add_to_cart_button, .eltdf-plc-text-inner .added_to_cart, .eltdf-plc-text-inner .add_to_cart_button, .eltdf-info-below-image .added_to_cart, .eltdf-info-below-image .add_to_cart_button, .product .yith-wcqv-button, .eltdf-info-below-image .yith-wcqv-button, .eltdf-plc-text-inner .yith-wcqv-button, .single_add_to_cart_button, .button.wc-forward, .eltdf-button.eltdf-out-of-stock, .eltdf-view-cart.eltdf-sc-dropdown-button, .eltdf-sc-dropdown-button, .price_slider_amount .button, .woocommerce-terms-and-conditions-wrapper .woocommerce_checkout_place_order, .coupon button, .coupon+button, .cart_form .add_to_cart, .woocommerce-form-login__submit, .button.wc-backward');
					if (otherButtons.length) {
						otherButtons.each(function() {
							buttonTypeOtherOutlineSlit($(this));
						});
					}
				})
			}
		};
	};
	
})(jQuery);