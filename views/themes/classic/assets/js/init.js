$(document).ready(function() {

	$('.tips').tipsy({gravity: 's'});
	
	$(".banner").fitVids();
	
	$('#news-ticker').innerfade({
		animationtype: 'slide', 
		speed: 'slow', 
		timeout: 6000, 
		type: 'random_start'
	});

	$('#motivasi').innerfade({
		animationtype: 'slide', 
		speed: 'slow', 
		timeout: 6000, 
		type: 'random_start'
	});

	$("a[rel^='prettyPhoto']").prettyPhoto();

	setInterval('currentTime()', 1000);
	
	$('ul.tree-menu').superfish();
	$(window).load(function(){
		$('.carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: true,
			slideshow: true,
			itemWidth: 144,
		});
	   
		$('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: true,
			slideshow: true, 
		});
	});

	$('.tabs a').click(function(){
		switch_tabs($(this));
	}); 
	switch_tabs($('.defaulttab')); 
	function switch_tabs(obj) {
		$('.tab-content').hide();
		$('.tabs a').removeClass("selected");
		var id = obj.attr("rel"); 
		$('#'+id).fadeIn(500);
		obj.addClass("selected");
	}

	if ( $( '.shortcode-toggle').length ) {	
			
		$( '.shortcode-toggle').each( function () {
				
			var toggleObj = $(this);
				
			toggleObj.closedText = toggleObj.find( 'input[name="title_closed"]').attr( 'value' );
			toggleObj.openText = toggleObj.find( 'input[name="title_open"]').attr( 'value' );
				
			toggleObj.find( 'input[name="title_closed"]').remove();
			toggleObj.find( 'input[name="title_open"]').remove();
				
			toggleObj.find( 'h4.toggle-trigger a').click( function () {
				
				toggleObj.find( '.toggle-content').animate({ opacity: 'toggle', height: 'toggle' }, 300);
				toggleObj.toggleClass( 'open' ).toggleClass( 'closed' );
					
				if ( toggleObj.hasClass( 'open') ) {
					
					$(this).text(toggleObj.openText);
					
				} // End IF Statement
					
				if ( toggleObj.hasClass( 'closed') ) {
					
					$(this).text(toggleObj.closedText);
					
				} // End IF Statement
					
				return false;
				
			});
						
		});
		
	} // End IF Statement
  
});