(function ($) {
    'use strict';
    
    var textMarquee = {};
    eltdf.modules.textMarquee = textMarquee;
    
    textMarquee.eltdfTextMarquee = eltdfTextMarquee;
    
    textMarquee.eltdfOnDocumentReady = eltdfOnDocumentReady;
    
    $(document).ready(eltdfOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfTextMarquee().init();
        eltdfMarqueeTextResize();
    }

    /*
     ** Custom Font resizing
     */
    function eltdfMarqueeTextResize() {
        var marqueeText = $('.eltdf-text-marquee');

        if (marqueeText.length) {
            marqueeText.each(function () {
                var thisMarqueeText = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if (eltdf.windowWidth < 1480) {
                    coef1 = 0.8;
                }

                if (eltdf.windowWidth < 1200) {
                    coef1 = 0.7;
                }

                if (eltdf.windowWidth < 768) {
                    coef1 = 0.55;
                    coef2 = 0.65;
                }

                if (eltdf.windowWidth < 600) {
                    coef1 = 0.45;
                    coef2 = 0.55;
                }

                if (eltdf.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                fontSize = parseInt(thisMarqueeText.css('font-size'));

                if (fontSize > 200) {
                    fontSize = Math.round(fontSize * coef1);
                } else if (fontSize > 60) {
                    fontSize = Math.round(fontSize * coef2);
                }

                thisMarqueeText.css('font-size', fontSize + 'px');

                lineHeight = parseInt(thisMarqueeText.css('line-height'));

                if (lineHeight > 70 && eltdf.windowWidth < 1440) {
                    lineHeight = '1.2em';
                } else if (lineHeight > 35 && eltdf.windowWidth < 768) {
                    lineHeight = '1.2em';
                } else {
                    lineHeight += 'px';
                }

                thisMarqueeText.css('line-height', lineHeight);

            });
        }
    }

    /**
     * Init Text Marquee effect
     */
    function eltdfTextMarquee() {
        var marquees = $('.eltdf-text-marquee');

        var Marquee = function (marquee) {
            this.holder = marquee;
            this.els = this.holder.find('.eltdf-marquee-element');
            this.delta = .05;
        }

        var inRange = function (el) {
            if (eltdf.scroll + eltdf.windowHeight >= el.offset().top &&
                eltdf.scroll < el.offset().top + el.height()) {
                return true;
            }

            return false;
        }

        var loop = function (marquee) {
            if (!inRange(marquee.holder)) {
                requestAnimationFrame(function () {
                    loop(marquee);
                });
                return false;
            } else {
                marquee.els.each(function (i) {
                    var el = $(this);
                    el.css('transform', 'translate3d(' + el.data('x') + '%, 0, 0)');
                    el.data('x', (el.data('x') - marquee.delta).toFixed(2));
                    el.offset().left < -el.width() - 25 && el.data('x', 100 * Math.abs(i - 1));
                })
                requestAnimationFrame(function () {
                    loop(marquee);
                });
            }
        }

        var init = function (marquee) {
            marquee.els.each(function (i) {
                $(this).data('x', 0);
            });

            requestAnimationFrame(function () {
                loop(marquee);
            });
        }

        return {
            init: function () {
                marquees.length &&
                marquees.each(function () {
                    var marquee = new Marquee($(this));

                    init(marquee);
                });
            }
        }
    }
})(jQuery);