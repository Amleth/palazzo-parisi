(function($) {
	'use strict';
	
	var roadmap = {};
	eltdf.modules.roadmap = roadmap;

	roadmap.eltdfInitRoadmap = eltdfInitRoadmap;

	roadmap.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitRoadmap();
	}

	function eltdfInitRoadmap() {
		var roadmap = $('.eltdf-roadmap');
		
		if (roadmap.length) {
			roadmap.each(function () {
				var thisRoadmap = $(this),
					roadMapHolder = thisRoadmap.find('.eltdf-roadmap-holder'),
					roadmapItemsHolder = thisRoadmap.find('.eltdf-roadmap-inner-holder'),
					roadmapItems = thisRoadmap.find('.eltdf-roadmap-item'),
					visibleItems = 5,
					roadmapInitalWidth = thisRoadmap.width(),
					roadmapHolderWidth = 0,
					itemsWidth,
					itemsHeight = 0,
					itemReached = roadmapItems.filter('.eltdf-roadmap-reached-item').last(),
					prevArrow = thisRoadmap.find('.eltdf-rl-arrow-left'),
					nextArrow = thisRoadmap.find('.eltdf-rl-arrow-right'),
					firstActive,
					lastActive,
					translateCurrent = 0,
					moving = false;

				itemReached.siblings().remove('eltdf-roadmap-reached-item');
				itemReached.prevAll().addClass('eltdf-roadmap-passed-item');

				//set width for items and holder, also set classes and first and last active items
				var setWidths = function(){
					roadmapInitalWidth = thisRoadmap.width();

					if (eltdf.windowWidth > 1024) {
						visibleItems = 5;
					} else if (eltdf.windowWidth > 680) {
						visibleItems = 3;
					} else {
						visibleItems = 1;
					}

					itemsWidth = roadmapInitalWidth/visibleItems;

					roadmapItems.each(function () {
						var thisItem = $(this),
							thisItemHeight;

						thisItem.width(itemsWidth);
						roadmapHolderWidth += itemsWidth;

						//needs to be here in order to calculate height right because of the width
						thisItemHeight = thisItem.find('.eltdf-roadmap-item-content-holder').outerHeight();

						if (itemsHeight < thisItemHeight){
							itemsHeight = thisItemHeight;
						}
					});

					roadmapItemsHolder.width(roadmapHolderWidth);
					thisRoadmap.css({'paddingTop': itemsHeight + 70, 'paddingBottom' : itemsHeight + 70});

					//if firstactive set change them accordingly
					if (typeof firstActive != 'undefined') {
						roadmapItems.removeClass('eltdf-roadmap-active-item');
						firstActive.addClass('eltdf-roadmap-active-item');
						for (var i = 0; i < visibleItems - 1; i++) {
							firstActive.nextAll().eq(i).addClass('eltdf-roadmap-active-item');
						}
						lastActive = roadmapItems.filter('.eltdf-roadmap-active-item').last();
					} else {
						roadmapItems.eq(visibleItems).prevAll().addClass('eltdf-roadmap-active-item');
						firstActive = roadmapItems.filter('.eltdf-roadmap-active-item').first();
						lastActive = roadmapItems.filter('.eltdf-roadmap-active-item').last();
					}
				};

				//movement for provided step (> 0 to the right, < 0 to the left)
				var moveRoadmap = function(step, timeout){
					var nextItem;
					//prevent multiple clicks while animating with moving  var
					if (!moving) {
						//grab item to be moved to
						if (step >= 1) {
							nextItem = lastActive.nextAll().eq(step - 1);
						} else {
							nextItem = firstActive.prevAll().eq(Math.abs(step) - 1);
						}
						if (nextItem.length) {
							moving = true;

							//adjust classes according to currently moved to item
							roadmapItems.removeClass('eltdf-roadmap-active-item');
							nextItem.addClass('eltdf-roadmap-active-item');
							
							var $i = 0;
							if (step >= 1) {
								for ($i; $i < visibleItems - 1; $i++) {
									nextItem.prevAll().eq(i).addClass('eltdf-roadmap-active-item');
								}
							} else {
								for ($i; $i < visibleItems - 1; $i++) {
									nextItem.nextAll().eq(i).addClass('eltdf-roadmap-active-item');
								}
							}

							//set new first and last active items
							firstActive = roadmapItems.filter('.eltdf-roadmap-active-item').first();
							lastActive = roadmapItems.filter('.eltdf-roadmap-active-item').last();

							//move holder and set var moving to false
							translateCurrent -= step*itemsWidth;
							roadmapItemsHolder.css({'transform': 'translateX(' + translateCurrent + 'px)'});
							setTimeout(function () {
								moving = false;
							}, timeout);
						}
					}
				};

				//move holder to provided item
				var moveTo = function(item){
					var firstActiveIndex = firstActive.index(),
						lastActiveIndex = lastActive.index(),
						goToIndex = item.index(),
						moveStep = 0,
						middle;

					middle = (firstActiveIndex + lastActiveIndex) / 2;

					//if first or second item, go to third item
					//else if last or one before, go to third form the back
					//else go to the desired
					if ( goToIndex < Math.floor(visibleItems/2)) {
						moveStep = firstActiveIndex - 2;
					} else if (goToIndex > roadmapItems.length - 1 - Math.floor(visibleItems/2)) {
						moveStep = roadmapItems.length - 1 - lastActiveIndex;
					} else {
						moveStep = goToIndex - middle;
					}
					moveRoadmap(moveStep, 0);
				};

				//adjust translate so it wouldn't be stopped in the middle of items
				var resizeTranslateAdj = function(){
					var adjustment = firstActive.index()*itemsWidth;

					translateCurrent = -adjustment;
					roadmapItemsHolder.css({'transform': 'translateX(' + translateCurrent + 'px)'});
				};

				//inital set of widths and items
				setWidths();

				//move to reached item
				moveTo(itemReached);

				//bind movement for prev and next arrow
				nextArrow.on("click", function () {
					moveRoadmap(1, 200); //init movement to to right
				});
				prevArrow.on("click", function () {
					moveRoadmap(-1, 200); //init movement to to right
				});

				//adjustments on resize
				$(window).resize(function(){
					setWidths();
					resizeTranslateAdj();
				});

                $('.eltdf-roadmap-item-content-holder').css('opacity', 0);
                $('.eltdf-roadmap-item-above .eltdf-roadmap-item-content-holder').css('transform', 'translateY(20px)');
                $('.eltdf-roadmap-item-below .eltdf-roadmap-item-content-holder').css('transform', 'translateY(-20px)');
			});

			roadmap.appear(function () {
				$('.eltdf-roadmap-item-content-holder').each(function(i) {
					var fadeInTime = 0.2 + i/5;

					$(this).css({
						'opacity' : 1,
						'transform': 'translateY(0)',
                        'transition':'transform .25s ease-in-out '+ fadeInTime +'s, opacity .25s ease-in-out '+ fadeInTime +'s '
					});
				});
			});
        }
	}
	
})(jQuery);