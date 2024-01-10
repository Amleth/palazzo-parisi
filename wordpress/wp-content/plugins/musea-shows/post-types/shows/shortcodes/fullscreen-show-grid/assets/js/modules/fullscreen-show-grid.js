(function($) {
	'use strict';

	var showFullscreenGrid = {};
	eltdf.modules.showFullscreenGrid = showFullscreenGrid;
	
	showFullscreenGrid.eltdfOnWindowLoad = eltdfOnWindowLoad;
	showFullscreenGrid.eltdfOnWindowResize = eltdfOnWindowResize;
	
	$(window).on('load', eltdfOnWindowLoad);
	$(window).resize(eltdfOnWindowResize);

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfShowFullscreenGrid();
		eltdfShowFullscreenGridSize();
	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function eltdfOnWindowResize() {
		eltdfShowFullscreenGridSize();
	}

	/**
	 * Initializes show list article animation
	 */
	function eltdfShowFullscreenGrid(){
		var fullscreenGrid = $('.eltdf-fullscreen-show-grid-holder');

		if (fullscreenGrid.length){
			fullscreenGrid.each(function () {
				var thisGrid = $(this),
					articles = thisGrid.find('.eltdf-fsg-item'),
					articlesLink = thisGrid.find('.eltdf-fsgi-link'),
					articlesImages = thisGrid.find('.eltdf-fsg-image-holder .eltdf-image-url-holder-inner');

	    		articlesImages.eq(0).addClass('hovered');

				//remove first click when on touch devices - go to link on second click
				if(eltdf.htmlEl.hasClass('touch')){
					articlesLink.eq(0).addClass('active');
            		articles.eq(0).addClass('hovered');

					articlesLink.each(function () {
						var link = $(this);

						link.on('click', function(e){
							if (!link.hasClass('active')) {
								e.preventDefault();
								articlesLink.removeClass('active');
								link.addClass('active');
							}

						});
					});
				}

				if (!eltdf.htmlEl.hasClass('touch')) {
					var randomize = function(n) {
					    var queue = new Array();

					    for (var i = 0; i < numberOfItems; i++) {
					        var queueElement = Math.floor(Math.random()*numberOfItems);

					        if( jQuery.inArray(queueElement, queue) > 0 ) { 
					            --i;
					        } else {
					            queue.push(queueElement);
					        }
					    }

					    return queue;
					};

					var numberOfItems = articles.length,
					    r = randomize(numberOfItems),
					    buffer = 0;

				    articles.each(function(i) {
				        var article = $(this);

				        setTimeout(function(){
				            article.addClass('eltdf-fade-out-cover').one(eltdf.animationEnd, function() {
				            	$(this).addClass('eltdf-remove-cover');
				            	buffer++;
				            	if(buffer == numberOfItems) {
				            		articles.addClass('eltdf-ready');
				            		articles.eq(0).addClass('hovered');
				            	}
				            });
				        },  r[i]*100);
				    });
				}

				articles.each(function(e){
					var thisArticle = $(this);

					thisArticle.on('mouseover', function () {

						var imageHolder = articlesImages.eq(e);

						if (!thisArticle.hasClass('hovered')){
							thisArticle.siblings().removeClass('hovered');
							imageHolder.siblings().removeClass('hovered');

							thisArticle.addClass('hovered');
							imageHolder.addClass('hovered');
						}
					});
				});

			});
		}
	}

	function eltdfShowFullscreenGridSize(){
		var fullscreenGrid = $('.eltdf-fullscreen-show-grid-holder');

		if (fullscreenGrid.length){
			fullscreenGrid.each(function () {
				var thisGrid = $(this),
					thisGridHeight,
					articlesHolder = thisGrid.find('.eltdf-fsg-holder-inner'),
					articles = thisGrid.find('.eltdf-fsg-item'),
					columns,
					postsNumber,
					numberOfRows,
					articleHeight,
					mobileHeaderHeight = $('.eltdf-mobile-header').height();


				if(eltdf.htmlEl.hasClass('touch')){
					thisGrid.css('height','calc(100vh - '+mobileHeaderHeight+'px)');
				}

				thisGridHeight = thisGrid.height();

				if (typeof thisGrid.data('col-number') !== 'undefined' && thisGrid.data('col-number') !== ''){
					columns = thisGrid.data('col-number');
				}

				if (typeof thisGrid.data('number-of-posts') !== 'undefined' && thisGrid.data('number-of-posts') !== ''){
					postsNumber = thisGrid.data('number-of-posts');
				}

				if (eltdf.windowWidth <= 480){
					columns = 1;
				} else if (eltdf.windowWidth <= 768){
					if (columns > 2){
						columns = 2;
					}
				}

				if (postsNumber !== 0){
					numberOfRows = Math.ceil(postsNumber/columns);
				}

				articleHeight = thisGridHeight/numberOfRows;

				if (eltdf.windowWidth <= 480){
					articleHeight = 'auto';
				}

				articles.each(function(e){
					var thisArticle = $(this);

					thisArticle.height(articleHeight);
				});

				//2px is for rounding of px
				if (articlesHolder.height() > thisGridHeight + 2){
					thisGrid.css('height','auto');
				}

				thisGrid.css('opacity',1);

			});
		}
	}

})(jQuery);