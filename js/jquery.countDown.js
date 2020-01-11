/*
	Class:    	countDown
	Author:   	David Walsh
	Website:    http://davidwalsh.name
	Version:  	1.0.0
	Date:     	11/30/2008
	Built For:  jQuery 1.2.6
*/

jQuery.fn.countDown = function(settings,to) {
	settings = jQuery.extend({
		startFontSize: '16px',
		endFontSize: '16px',
		color: '#00CCFF',
		duration: 1000,
		startNumber: 10,
		endNumber: 0,
		callBack: function() { }
	}, settings);
	return this.each(function() {
		
		//where do we start?
		if(!to && to != settings.endNumber) { to = settings.startNumber; }
		
		//set the countdown to the starting number
		$(this).text(to).css('fontSize',settings.startFontSize).css('color',settings.color);
		
		//loopage
		$(this).animate({
			'fontSize': settings.endFontSize
		},settings.duration,'',function() {
			if(to > settings.endNumber + 1) {
				$(this).css('fontSize',settings.startFontSize).css('color',settings.color).countDown(settings,to - 1);
			}
			else
			{
				settings.callBack(this);
			}
		});
				
	});
};
