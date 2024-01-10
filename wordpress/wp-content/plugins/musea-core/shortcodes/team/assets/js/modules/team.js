(function($) {
    'use strict';

    var team = {};
    eltdf.modules.team = team;

    team.eltdfInitTeam = eltdfInitTeam;


    team.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitTeam();
    }

    /*
     **	Init team shortcode
     */
    function eltdfInitTeam(){
        var team = $('.eltdf-team-holder');

        if(team.length){
            team.each(function(){
                var teamItem            = $(this),
                    socialIconsHolder   = teamItem.find('.eltdf-team-social-holder'),
                    socialIcons         = teamItem.find('.eltdf-team-social-floating'),
                    socialIconsWidth    = socialIcons.outerWidth(true),
                    singleIconWidth     = $('.eltdf-team-social-opener').outerWidth(true);

                socialIconsHolder.css('width', socialIconsWidth + singleIconWidth + 90);



                teamItem.on('mouseenter', function(){
                    socialIcons.stop(true,true).animate({
                        left: singleIconWidth,
                    }, {duration: 350, easing: "easeOutCubic" }, function() {
                    });
                });

                teamItem.on('mouseleave',function(){
                    socialIcons.stop(true,true).animate({
                        left: -socialIconsWidth,
                    }, {duration: 250, easing: "easeOutCubic" }, function() {
                    });
                });

            });
        }
    }

})(jQuery);