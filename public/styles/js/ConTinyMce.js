var csrf_token,url,id,commentBox,idComment;
csrf_token = $(".addCommentForm input[type='hidden']").val();
function editCommentModal(thiz){
	$('#modalEditComment').modal();
	$('#modalEditComment').modal('open');
	var Comment = $(thiz).parent().parent().children('.Comment').html();
	tinyMCE.get('editComment').setContent(Comment);
	idComment = $(thiz).parent().children('.deleteCommentA').attr('id');
}
function openModalDeleteComment(thiz){
	$('#deleteCommentModal').modal();
	$('#deleteCommentModal').modal('open');
	url = $(thiz).attr('url');
	id = $(thiz).attr('id');
	commentBox = $(thiz).parent().parent();
}
function deleteComment(){
	var data = {
		'_token':csrf_token,
		'id':id
	}
	$.ajax({
		url:url,
		method:'POST',
		data:data,
		dataType:'json',
		complete: function(data){
			if (data['responseText']=='done'){
				commentBox.fadeOut(500,function(){
					$(this).remove();
				});
			}else{

			}
		}
	});
	return false;
}
function getCountCharacters(){
	var strip = tinyMCE.activeEditor.getContent({format:'raw'}).replace(/<.[^<>]*?>/g, "").replace(/&nbsp;|&#160;| /gi, "");
	return strip.length;
};
function update(){
	tinyMCE.activeEditor.theme.panel.find('#wordcount').text(['Characters: {0}',getCountCharacters()]);
}
function Validate(e){
	if (getCountCharacters()>=500){
		if (e.which==8){
			return true;
		}else{
			tinyMCE.activeEditor.notificationManager.open({
			  text: 'الحد الاقصي للتعليق 500 حرف',
			  type: 'error',
			  timeout: 2500,
			  closeButton: true,
			});
			return e.preventDefault();
		}
	}
	if (e.which==9){
		tinyMCE.activeEditor.execCommand("insertParagraph",false);
		return e.preventDefault();
	}
	if (e.which==13){
		if ($('.submitAddComment').css('display')=='none'){
			if (getCountCharacters()>=10){
				if (tinyMCE.activeEditor['id']=='editComment'){
					editComment();
				}else{
					addComment();
				}
				return false;
			}else if (getCountCharacters()<10){
				tinyMCE.activeEditor.notificationManager.open({
				  text: 'الحد الادني للتعليق 10 أحرف',
				  type: 'error',
				  timeout: 2500,
				  closeButton: true,
				});
				return e.preventDefault();
			}
		}else{}
	}
}
function addComment(){
	var href;
	var d = new Date();
	var s = d.getSeconds();
	href = $('.addCommentForm').attr('action');
	var data = {
		'_token':csrf_token,
		'comment':tinyMCE.activeEditor.getContent({format:'raw'}),
		'seconds':s,
	}
	if (getCountCharacters()>=500){
		tinyMCE.activeEditor.notificationManager.open({
		  text: 'الحد الاقصي للتعليق 500 حرف',
		  type: 'error',
		  timeout: 2500,
		  closeButton: true,
		});
	}else if (getCountCharacters()<10){
		tinyMCE.activeEditor.notificationManager.open({
		  text: 'الحد الادني للتعليق 10 أحرف',
		  type: 'error',
		  timeout: 2500,
		  closeButton: true,
		});
	}else{
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
					tinyMCE.activeEditor.notificationManager.open({
					  text: 'حدث خطأ , من فضلك اعد تحميل الصفحة <a href="javascript:;" onclick="location.reload();">اعادة تحميل الصفحة</a> او لا تكتب تعليقاً كبيراً',
					  type: 'error',
					  timeout: 2500,
					  closeButton: true,
					});
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
					$('.deleteCommentA').attr('onclick',"openModalDeleteComment($(this));");
					$('.editCommentA').attr('onclick',"editCommentModal($(this));");
					tinyMCE.activeEditor.setContent('');
				}
			}
		});
	}
}
function editComment(){
	var href = $('.editCommentForm').attr('action');
	href += '/'+idComment;
	var data = {
		'_token':csrf_token,
		'comment':tinyMCE.get('editComment').getContent({format:'raw'}),
	}
	if (getCountCharacters()>=500){
		tinyMCE.get('editComment').notificationManager.open({
		  text: 'الحد الاقصي للتعليق 500 حرف',
		  type: 'error',
		  timeout: 2500,
		  closeButton: true,
		});
	}else if (getCountCharacters()<10){
		tinyMCE.get('editComment').notificationManager.open({
		  text: 'الحد الادني للتعليق 10 أحرف',
		  type: 'error',
		  timeout: 2500,
		  closeButton: true,
		});
	}else{
		$.ajax({
			url: href,
			method: 'POST',
			dataType: 'json',
			data: data,
			error: function(status){
				if (status['status']==500||data['responseText']=='fail'){
					tinyMCE.get('editComment').notificationManager.open({
					  text: 'حدث خطأ , من فضلك اعد تحميل الصفحة <a href="javascript:;" onclick="location.reload();">اعادة تحميل الصفحة</a> او لا تكتب تعليقاً كبيراً',
					  type: 'error',
					  timeout: 2500,
					  closeButton: true,
					});
				}
			},
			complete: function(data){
				if (data['responseText']=='edited'){
					window.location.reload(true);
				}
			}
		});
	}
}
$(document).ready(function(){
	$('.editCommentForm').submit(function(){
		editComment();
		return false;
	});
	$('.deleteCommentA').on('click',function(){
		openModalDeleteComment($(this));
	});
	$('.addCommentForm').submit(function(){
		addComment();
		return false;
	});
	$('.editCommentA').on('click',function(){
		editCommentModal($(this));
	});
	$('.Yes').on('click',function(){
		deleteComment();
	});
	$('.submitEditComment').on('click',function(){
		editComment();
		return false;
	});
	tinymce.init({
		selector:'textarea',
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
				Validate(e);
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
});