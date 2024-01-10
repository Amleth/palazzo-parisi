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
(function($) {
    'use strict';
	
	
	var showList = {};
	eltdf.modules.showList = showList;
	
	showList.eltdfOnDocumentReady = eltdfOnDocumentReady;
	showList.eltdfOnWindowLoad = eltdfOnWindowLoad;
	showList.eltdfOnWindowResize = eltdfOnWindowResize;
	showList.eltdfOnWindowScroll = eltdfOnWindowScroll;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);
	$(window).resize(eltdfOnWindowResize);
	$(window).scroll(eltdfOnWindowScroll);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
	
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfInitShowMasonry();
		eltdfInitShowPagination().init();
	}
	
	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function eltdfOnWindowResize() {
		eltdfInitShowMasonry();
	}
	
	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function eltdfOnWindowScroll() {
		eltdfInitShowPagination().scroll();
	}
	/**
	 * Initializes show list
	 */
	function eltdfInitShowMasonry(){
		var holder = $('.eltdf-show-list-holder.eltdf-sl-masonry');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.children('.eltdf-sl-inner'),
					size = thisHolder.find('.eltdf-sl-grid-sizer').width();
				
				masonry.isotope({
					layoutMode: 'packery',
					itemSelector: '.eltdf-show',
					percentPosition: true,
					packery: {
						gutter: '.eltdf-sl-grid-gutter',
						columnWidth: '.eltdf-sl-grid-sizer'
					}
				});
				
				eltdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('.eltdf-show'), size);
				
				setTimeout(function () {
					eltdf.modules.common.eltdfInitParallax();
				}, 600);
				
				masonry.isotope( 'layout').css('opacity', '1');
			});
		}
	}
	
	/**
	 * Initializes show pagination functions
	 */
	function eltdfInitShowPagination(){
		var showList = $('.eltdf-show-list-holder');
		
		var initStandardPagination = function(thisShowList) {
			var standardLink = thisShowList.find('.eltdf-sl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisShowList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisShowList) {
			var loadMoreButton = thisShowList.find('.eltdf-sl-load-more a');
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisShowList);
			});
		};
		
		var initInifiteScrollPagination = function(thisShowList) {
			var showListHeight = thisShowList.outerHeight(),
				showListTopOffest = thisShowList.offset().top,
				showListPosition = showListHeight + showListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisShowList.hasClass('eltdf-sl-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > showListPosition) {
				initMainPagFunctionality(thisShowList);
			}
		};
		
		var initMainPagFunctionality = function(thisShowList, pagedLink) {
			var thisShowListInner = thisShowList.find('.eltdf-sl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisShowList.data('max-num-pages') !== 'undefined' && thisShowList.data('max-num-pages') !== false) {
				maxNumPages = thisShowList.data('max-num-pages');
			}
			
			if(thisShowList.hasClass('eltdf-sl-pag-standard')) {
				thisShowList.data('next-page', pagedLink);
			}
			
			if(thisShowList.hasClass('eltdf-sl-pag-infinite-scroll')) {
				thisShowList.addClass('eltdf-sl-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisShowList),
				loadingItem = thisShowList.find('.eltdf-sl-loading');
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisShowList.hasClass('eltdf-sl-pag-standard')) {
					loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
					thisShowList.addClass('eltdf-sl-pag-standard-animate');
				} else {
					loadingItem.addClass('eltdf-showing');
				}
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'musea_shows_show_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdfGlobalVars.vars.eltdfAjaxUrl,
					success: function (data) {
						if(!thisShowList.hasClass('eltdf-sl-pag-standard')) {
							nextPage++;
						}
						
						thisShowList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisShowList.hasClass('eltdf-sl-pag-standard')) {
							eltdfInitStandardPaginationLinkChanges(thisShowList, maxNumPages, nextPage);
							
							thisShowList.waitForImages(function(){
								if(thisShowList.hasClass('eltdf-sl-masonry')){
									eltdfInitHtmlIsotopeNewContent(thisShowList, thisShowListInner, loadingItem, responseHtml);
								} else if (thisShowList.hasClass('eltdf-sl-gallery') && thisShowList.hasClass('eltdf-sl-has-filter')) {
									eltdfInitHtmlIsotopeNewContent(thisShowList, thisShowListInner, loadingItem, responseHtml);
								} else {
									eltdfInitHtmlGalleryNewContent(thisShowList, thisShowListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisShowList.waitForImages(function(){
								if(thisShowList.hasClass('eltdf-sl-masonry')){
									if(pagedLink == 1) {
										eltdfInitHtmlIsotopeNewContent(thisShowList, thisShowListInner, loadingItem, responseHtml);
									} else {
										eltdfInitAppendIsotopeNewContent(thisShowList, thisShowListInner, loadingItem, responseHtml);
									}
								} else if (thisShowList.hasClass('eltdf-sl-gallery') && thisShowList.hasClass('eltdf-sl-has-filter') && pagedLink != 1) {
									eltdfInitAppendIsotopeNewContent(thisShowList, thisShowListInner, loadingItem, responseHtml);
								} else {
									if (pagedLink == 1) {
										eltdfInitHtmlGalleryNewContent(thisShowList, thisShowListInner, loadingItem, responseHtml);
									} else {
										eltdfInitAppendGalleryNewContent(thisShowListInner, loadingItem, responseHtml);
									}
								}
							});
						}
						
						if(thisShowList.hasClass('eltdf-sl-infinite-scroll-started')) {
							thisShowList.removeClass('eltdf-sl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisShowList.find('.eltdf-sl-load-more-holder').hide();
			}
		};
		
		var eltdfInitStandardPaginationLinkChanges = function(thisShowList, maxNumPages, nextPage) {
			var standardPagHolder = thisShowList.find('.eltdf-sl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.eltdf-sl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.eltdf-sl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.eltdf-sl-pag-next a');
			
			standardPagNumericItem.removeClass('eltdf-sl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('eltdf-sl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var eltdfInitHtmlIsotopeNewContent = function(thisShowList, thisShowListInner, loadingItem, responseHtml) {
			thisShowListInner.find('.eltdf-show').remove();
			thisShowListInner.append(responseHtml);
			eltdf.modules.common.setFixedImageProportionSize(thisShowList, thisShowListInner.find('.eltdf-show'), thisShowListInner.find('.eltdf-sl-grid-sizer').width());
			thisShowListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisShowList.removeClass('eltdf-sl-pag-standard-animate');
			
			setTimeout(function() {
				thisShowListInner.isotope('layout');
				eltdf.modules.common.eltdfInitParallax();
				eltdf.modules.common.eltdfPrettyPhoto();
			}, 600);
		};
		
		var eltdfInitHtmlGalleryNewContent = function(thisShowList, thisShowListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisShowList.removeClass('eltdf-sl-pag-standard-animate');
			thisShowListInner.html(responseHtml);
			eltdf.modules.common.eltdfInitParallax();
			eltdf.modules.common.eltdfPrettyPhoto();
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisShowList, thisShowListInner, loadingItem, responseHtml) {
			thisShowListInner.append(responseHtml);
			eltdf.modules.common.setFixedImageProportionSize(thisShowList, thisShowListInner.find('.eltdf-show'), thisShowListInner.find('.eltdf-sl-grid-sizer').width());
			thisShowListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisShowListInner.isotope('layout');
				eltdf.modules.common.eltdfInitParallax();
				eltdf.modules.common.eltdfPrettyPhoto();
			}, 600);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisShowListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisShowListInner.append(responseHtml);
			eltdf.modules.common.eltdfInitParallax();
			eltdf.modules.common.eltdfPrettyPhoto();
		};
		
		return {
			init: function() {
				if(showList.length) {
					showList.each(function() {
						var thisShowList = $(this);
						
						if(thisShowList.hasClass('eltdf-sl-pag-standard')) {
							initStandardPagination(thisShowList);
						}
						
						if(thisShowList.hasClass('eltdf-sl-pag-load-more')) {
							initLoadMorePagination(thisShowList);
						}
						
						if(thisShowList.hasClass('eltdf-sl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisShowList);
						}
					});
				}
			},
			scroll: function() {
				if(showList.length) {
					showList.each(function() {
						var thisShowList = $(this);
						
						if(thisShowList.hasClass('eltdf-sl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisShowList);
						}
					});
				}
			},
			getMainPagFunction: function(thisShowList, paged) {
				initMainPagFunctionality(thisShowList, paged);
			}
		};
	}

})(jQuery);