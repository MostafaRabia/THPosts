$(document).ready(function(){
	$(".show-Types").sideNav({edge:'right',draggable:true});
	new WOW().init();
	$('select').material_select();
	$('.select-SortBy').on('change',function(){
		var actionRoute = $('.active span').attr('route');
		$(this).parent().attr('action',actionRoute);
		$(this).parent().submit();
	});
});
$(window).on('load',function(){
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