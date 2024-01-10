(function($) {
	'use strict';
	
	var countdown = {};
	eltdf.modules.countdown = countdown;
	
	countdown.eltdfInitCountdown = eltdfInitCountdown;
	
	
	countdown.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function eltdfInitCountdown() {
		var countdowns = $('.eltdf-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			currentYear = date.getFullYear(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel,
			monthSingularLabel,
			daySingularLabel,
			hourSingularLabel,
			minuteSingularLabel,
			secondSingularLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				monthSingularLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				daySingularLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				hourSingularLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				minuteSingularLabel = countdown.data('minute-label');
				secondLabel =countdown.data('second-label');
				secondSingularLabel =countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( typeof countdown.data('month-singular-label') !== 'undefined' && countdown.data('month-singular-label') !== '' ){
					monthSingularLabel = countdown.data('month-singular-label');
				}

				if( typeof countdown.data('day-singular-label') !== 'undefined' && countdown.data('day-singular-label') !== '' ){
					daySingularLabel = countdown.data('day-singular-label');
				}

				if( typeof countdown.data('hour-singular-label') !== 'undefined' && countdown.data('hour-singular-label') !== '' ){
					hourSingularLabel = countdown.data('hour-singular-label');
				}

				if( typeof countdown.data('minute-singular-label') !== 'undefined' && countdown.data('minute-singular-label') !== '' ){
					minuteSingularLabel = countdown.data('minute-singular-label');
				}

				if( typeof countdown.data('second-singular-label') !== 'undefined' && countdown.data('second-singular-label') !== '' ){
					secondSingularLabel = countdown.data('second-singular-label');
				}

				if( currentMonth !== month || currentYear !== year ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					labels1: ['', monthSingularLabel, '', daySingularLabel, hourSingularLabel, minuteSingularLabel, secondSingularLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
