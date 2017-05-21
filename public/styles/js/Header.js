$(document).ready(function(){
	$(".show-Types").sideNav({edge:'right',draggable:true});
	$('select').material_select();
	$('.select-SortBy').on('change',function(){
		var actionRoute = $('.active span').attr('route');
		$(this).parent().attr('action',actionRoute);
		$(this).parent().submit();
	});
	// $fn.scrollSpeed(step, speed, easing);
	$.scrollSpeed(100, 1000);
});
$(window).on('load',function(){
	$('body').css('overflow','hidden');
	$('.posts-Section').hide();
	$('.sectionPost').hide();
	$('#loader-Section div').fadeOut(1000,function(){
		$('.posts-Section').show();
		$('.sectionPost').show();
		$('body').css('overflow','auto');
		$(this).parent().fadeOut(1000,function(){
			$(this).remove();
		});
	});
});