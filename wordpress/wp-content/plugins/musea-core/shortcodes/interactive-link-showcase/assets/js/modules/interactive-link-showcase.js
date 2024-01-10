(function($) {
    'use strict';

    var interactiveLinkShowcase = {};
    eltdf.modules.interactiveLinkShowcase = interactiveLinkShowcase;

    interactiveLinkShowcase.eltdfInitInteractiveLinkShowcase = eltdfInitInteractiveLinkShowcase;
    interactiveLinkShowcase.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitInteractiveLinkShowcase();
    }

    /**
     * Init item showcase shortcode
     */
    function eltdfInitInteractiveLinkShowcase() {
        var interactiveLinkShowcase = $('.eltdf-ils-holder');
	
	    if (interactiveLinkShowcase.length) {
		    interactiveLinkShowcase.each(function(){
			    var thisInteractiveLinkShowcase = $(this),
				    singleImage = thisInteractiveLinkShowcase.find('.eltdf-ils-item-image'),
				    singleLink  = thisInteractiveLinkShowcase.find('.eltdf-ils-item-link');
			    
			    singleImage.eq(0).addClass('eltdf-active');
			    thisInteractiveLinkShowcase.find('.eltdf-ils-item-link[data-index="0"]').addClass('eltdf-active');
			
			    singleLink.children().on('touchstart mouseenter', function() {
				    var thisLink = $(this).parent(),
					    index = parseInt( thisLink.data('index'), 10 );
				
				    singleImage.removeClass('eltdf-active').eq(index).addClass('eltdf-active');
				    singleLink.removeClass('eltdf-active');
				    thisInteractiveLinkShowcase.find('.eltdf-ils-item-link[data-index="'+index+'"]').addClass('eltdf-active');
			    });
		    });
	    }
    }

})(jQuery);