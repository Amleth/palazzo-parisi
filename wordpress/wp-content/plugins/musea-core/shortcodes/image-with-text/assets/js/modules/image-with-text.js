(function($) {
    'use strict';

    var scrollingImage = {};
    eltdf.modules.scrollingImage = scrollingImage;

    scrollingImage.eltdfScrollingImage = eltdfScrollingImage;

    scrollingImage.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfScrollingImage();
    }

    /**
     * Init Scrolling Image effect
     */
    function eltdfScrollingImage() {
        var scrollingImageShortcodes = $('.eltdf-image-with-text-holder.eltdf-image-behavior-scrolling-image');

        if (scrollingImageShortcodes.length) {
            scrollingImageShortcodes.each(function(){
                var scrollingImageShortcode = $(this),
                    scrollingImageContentHolder = scrollingImageShortcode.find('.eltdf-iwt-image'),
                    scrollingFrame = scrollingImageShortcode.find('.eltdf-iwt-frame'),
                    scrollingFrameHeight,
                    scrollingFrameWidth,
                    scrollingImage = scrollingImageShortcode.find('.main-image'),
                    scrollingImageHeight,
                    scrollingImageWidth,
                    delta,
                    timing,
                    scrollable = false,
                    horizontal = scrollingImageShortcode.hasClass('eltdf-scrolling-horizontal');

                var sizing = function() {
                    scrollingFrameHeight = scrollingFrame.height();
                    scrollingImageHeight = scrollingImage.height();
                    scrollingFrameWidth  = scrollingFrame.width();
                    scrollingImageWidth  = scrollingImage.width();
                    if (horizontal) {
                        delta = Math.round(scrollingImageWidth - scrollingFrameWidth);
                        timing = Math.round(scrollingImageWidth/scrollingFrameWidth)*2;
                    } else {
                        delta = Math.round(scrollingImageHeight - scrollingFrameHeight);
                        timing = Math.round(scrollingImageHeight/scrollingFrameHeight)*2;
                    }

                    if (horizontal) {
                        if (scrollingImageWidth > scrollingFrameWidth) {
                            scrollable = true;
                        }
                    } else {
                        if (scrollingImageHeight > scrollingFrameHeight) {
                            scrollable = true;
                        }
                    }
                }

                var scrollAnimation = function() {
                    //scroll animation on hover
                    scrollingImageContentHolder.mouseenter(function(){
                        scrollingImage.css('transition-duration',timing+'s'); //transition duration set in relation to image height
                        if (horizontal) {
                            scrollingImage.css('transform', 'translate3d(-'+delta+'px, 0px, 0px)');
                        } else {
                            scrollingImage.css('transform', 'translate3d(0px, -'+delta+'px, 0px)');
                        }});

                    //scroll animation reset
                    scrollingImageContentHolder.mouseleave(function(){
                        if (scrollable) {
                            scrollingImage.css('transition-duration', Math.min(timing/3, 3) +'s');
                            scrollingImage.css('transform', 'translate3d(0px, 0px, 0px)');
                        }
                    });
                };

                //init
                scrollingImageShortcode.waitForImages(function(){
                    scrollingImageShortcode.css('visibility', 'visible');
                    sizing();
                    scrollAnimation();
                });

                $(window).resize(function(){
                    sizing();
                });
            });
        }
    }
})(jQuery);