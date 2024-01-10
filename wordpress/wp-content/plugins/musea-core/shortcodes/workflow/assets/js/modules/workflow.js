(function($) {
	'use strict';
	
	var workflow = {};

	eltdf.modules.workflow = workflow;

    workflow.eltdfWorkflow = eltdfWorkflow;

    workflow.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
        eltdfWorkflow();
	}

    function eltdfWorkflow() {
        var workflowShortcodes = $('.eltdf-workflow');

        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this),
                    workflowMainLine = workflowShortcode.find('.main-line');

                if (workflowShortcode.hasClass('eltdf-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.eltdf-workflow-item');
                    var lastWorkFlowItem = workflowItems.last();

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('eltdf-appeared');
                    }, {accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});

                    workflowItems.appear(function () {
                        var workflowItem = $(this);
                        workflowItem.addClass('eltdf-appeared');

                        $(window).scroll(function () {
                            var appearedWorkflowItem = workflowItems.filter('.eltdf-appeared').last(),
                                appearedWorkflowCircle = appearedWorkflowItem.find('.circle'),
                                distance = appearedWorkflowCircle.offset().top - workflowMainLine.offset().top;

                            workflowMainLine.css('height', distance);

                            if(lastWorkFlowItem.hasClass('eltdf-appeared')) {
                                workflowMainLine.css('height', '100%');
                            }
                        });
                    }, {accX: 0, accY: -250});
                }
            });
        }
    }
	
})(jQuery);