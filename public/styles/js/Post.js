function Include(){
	$('.commentDiv').prepend("<script src='"+$('.tinymce_js').val()+"'></script>");
	$('.commentDiv').prepend("<script src='"+$('.conf_tinymce_js').val()+"'></script>");
}
$(document).ready(function(){
	$('.showComments').on('click',function(){
		Include();
		$('.commentDiv').show();
	});
	if ($('.commentDiv').css('display')=='block'){
		Include();
	}
});