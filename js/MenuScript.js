$(document).ready(function(){
	$('.menu-toggle').click(function(){
		$('nav, .container, .menu-toggle i').toggleClass('active');
	});
	$('nav').click(function(event) {
		var target = $( event.target );
		if (target.is('.menu-item-has-children a')) {
			target.parent('.menu-item-has-children').toggleClass('active');
		} else if (target.is('.menu-item-has-children')) {
			target.toggleClass('active');
		}
	});
	$('ul li').click(function(){
		$(this).siblings().removeClass('active');	
	});
	$('ul li:not(.menu-item-has-children)').click(function(){	
		$(this).toggleClass('active');
	});

});