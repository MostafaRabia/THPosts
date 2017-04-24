function getCountCharacters() {
	var strip = tinyMCE.activeEditor.getContent({format:'raw'}).replace(/<.[^<>]*?>/g, "").replace(/&nbsp;|&#160;| /gi, "");
	return strip.length;
};
function update() {
	tinyMCE.activeEditor.theme.panel.find('#wordcount').text(['Characters: {0}',getCountCharacters()]);
}
function addComment(){
	var d = new Date();
	var s = d.getSeconds();
	var csrf_token = $("input[type='hidden']").val();
	var href = $('.addCommentForm').attr('action');
	var data = {
		'_token':csrf_token,
		'comment':tinyMCE.activeEditor.getContent({format:'raw'}),
		'seconds':s,
	}
	$.ajax({
		url: href,
		method: 'POST',
		dataType: 'json',
		data: data,
		beforeSend: function(){
			$('.preloader-wrapper').css('display','block');
			$('.addCommentInput').css({'height':'22px'});
		},
		error: function(status){
			if (status['status']==500){
				$('#Modal h4').text('خطأ');
				$('#Modal p').html('حدث خطأ , من فضلك اعد تحميل الصفحة <a href="javascript:;" onclick="location.reload();">اعادة تحميل الصفحة</a> او لا تكتب تعليقاً فارغاً');
				$('#Modal').modal();
				$('#Modal').modal('open');
			}
		},
		complete: function(data){
			$('.preloader-wrapper').css('display','none');
			if (data['responseJSON']['status']!='done'){
				var Seconds;
				if (data['responseJSON']['seconds']<11&&data['responseJSON']['seconds']>2){
					Seconds = 'ثواني';
				}else{
					Seconds = 'ثانية';
				}
				if (data['responseJSON']['status']=='Wait'){
					tinyMCE.activeEditor.notificationManager.open({
					  text: data['responseJSON']['messageWait']+': '+data['responseJSON']['seconds']+' '+Seconds,
					  type: 'error',
					  timeout: 2500,
					  closeButton: true,
					});
				}
			}else{
				$('.addCommentInput').val('').css({'height':'22px'});
				$('.commentBox-Parent').prepend(data['responseJSON']['div']);
				$('.deleteCommentA').attr('onclick',"$('#deleteCommentModal').modal();$('#deleteCommentModal').modal('open');var url = $(this).attr('url');$('.Yes').attr('href',url);");
				tinyMCE.activeEditor.setContent('');
			}
		}
	});
}
$(document).ready(function(){
	tinymce.init({
		selector:'#addComment',
		convert_newlines_to_brs:true,
		plugins: [
		   "advlist link lists textcolor",
		],
		toolbar: "undo redo | styleselect | bold underline italic | alignleft aligncenter alignright | forecolor backcolor fontsizeselect | link",
		invalid_styles: 'font-size',
		invalid_elements : 'form,input,button',
		protect: [
		    /\<\/?(if|endif)\>/g,
		    /\<xsl\:[^>]+\>/g,
		    /<\?php.*?\?>/g
		],
		content_css:'/THPosts/public/styles/css/tinymce.css',
		content_style:'*{direction:rtl}',
		setup:function(ed){
			ed.on('keydown',function(e){
				if (getCountCharacters()>=500){
					if (e.which==8){
						return true;
					}else{
						ed.notificationManager.open({
						  text: 'الحد الاقصي للتعليق 500 حرف',
						  type: 'error',
						  timeout: 2500,
						  closeButton: true,
						});
						return false;
					}
				}
				if (e.which==9){
					ed.execCommand("insertParagraph",false);
					return false;
				}
				if(e.which==13){
					if ($('.submitAddComment').css('display')=='none'){
						if (getCountCharacters()>=10){
							addComment();
							return false;
						}else{
							ed.notificationManager.open({
							  text: 'الحد الادني للتعليق 10 حروف',
							  type: 'error',
							  timeout: 2500,
							  closeButton: true,
							});
							return false;
						}
					}else{
						ed.execCommand("insertParagraph",false);
					}
				}
			});
			ed.on('init', function() {
		        var statusbar = ed.theme.panel && ed.theme.panel.find('#statusbar')[0];
		        if (statusbar) {
		            window.setTimeout(function() {
		                statusbar.insert({
		                    type: 'label',
		                    name: 'wordcount',
		                    text: ['Characters: {0}',getCountCharacters()],
		                    classes: 'wordcount'
		                }, 0);
		                ed.on('setcontent beforeaddundo keyup', update);
		            }, 0);
		        }
		    });
		},
		menubar:false,
		resize:false,
		
	});
	$('.showComments').on('click',function(){
		$('.commentDiv').show();
	});
	$('.deleteCommentA').on('click',function(){
		$('#deleteCommentModal').modal();
		$('#deleteCommentModal').modal('open');
		var url = $(this).attr('url');
		$('.Yes').attr('href',url);
	});
	$('.addCommentForm').submit(function(){
		addComment();
		return false;
	});
});