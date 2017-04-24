@extends(app('normal').'.Index')
@section('center')
{!! Html::style(app('css').'/Post.css') !!}
{!! Html::script(app('js').'/Post.min.js') !!}
{!! Html::script(app('js').'/tinymce/tinymce.min.js') !!}
<!-- Start Section Post -->
<section class="sectionPost">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="post-Item-Div">
					<div class="imgDiv">
						<img src='{{app("image")}}/{{$post->image}}' class="responsive-img" alt='{{$post->image}}'/>
						<div class='blackImg'></div>
						<div class='imgProfile'>
					 		<a href="{{url('profile/'.$post->Authors->id)}}"><img src='{{$post->Authors->image}}' alt='{{$post->image}}'/></a>
						</div> 
					</div>
					<div class='postDiv'>
						<h3>{{$post->title}}</h3>
						<div class="information">
							<div class='informationAuthor'>
								<i class="material-icons">edit</i> <a href="{{url('profile/'.$post->Authors->id)}}"> {{$post->Authors->nickname}}</a>
							</div>
							<div class="informationType">
								<a href='{{url("type/".$post->Type->id)}}'>{{$post->Type->hash}}</a>  
							</div>
							<div class="Likes">
								<i class="material-icons">remove_red_eye</i> {{$post->readed}}  
								<i class="material-icons">thumb_up</i> {{$post->likes}}
							</div>
						</div>
						<p class="post">{!!$post->post!!}</p>
						<div class='opinionDiv'>
							<div class="fixed-action-btn toolbar">
								<a class="btn-floating btn-large red">
									<i class="material-icons">info_outline</i>
								</a>
								<ul>
									<li class="waves-effect waves-light"><a href="{{url('like/'.$post->id)}}" class="a-opinion"><i class="material-icons @if(isset($opinion)&&$opinion->opinion=='Like') Like @endif ">mood</i></a></li>
									<li class="waves-effect waves-light"><a href="{{url('deslike/'.$post->id)}}" class="a-opinion"><i class="material-icons @if(isset($opinion)&&$opinion->opinion=='Deslike') Desike @endif ">mood_bad</i></a></li>
									<li class="waves-effect waves-light"><a href="javascript:;" class="showComments"><i class="material-icons">mode_comment</i> ({{$countComments}})</a></li>
									<li class="waves-effect waves-light"><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="material-icons">share</i></a></li>
								</ul>
							</div>
						</div>
						<div class="commentDiv">
							@if (!auth()->guest())
								<div class="input-field">
									{!! Form::open(['url'=>'addcomment/'.$post->id,'method'=>'post','class'=>'addCommentForm ']) !!}
									<textarea id="addComment" class="materialize-textarea addCommentInput" autofocus data-length="500" name="addComment"></textarea>
									<button type="submit" class="btn-floating btn-small waves-effect waves-light red hide-on-large-only submitAddComment"><i class="material-icons">send</i></button>
									{!! Form::close() !!}
									<blockquote class="noteAddComment hide-on-med-and-down">
										{!! trans('Post.noteAddComment') !!}
							    	</blockquote>
								</div>
							@else
								<blockquote class="loginToComment">
									{{trans('Post.loginToComment')}} <a href="{{url('login')}}">{{trans('Post.Login')}}</a> | <a href="{{url('facebook/redirect')}}">{{trans('Post.loginByFacebook')}}</a> | <a href="{{url('google/redirect')}}">{{trans('Post.loginByGoogle')}}</a>
							    </blockquote>
							@endif
							<!-- Start Preloader -->
							<div class="preloader-wrapper small active center">
						      <div class="spinner-layer spinner-blue">
						        <div class="circle-clipper left">
						          <div class="circle"></div>
						        </div><div class="gap-patch">
						          <div class="circle"></div>
						        </div><div class="circle-clipper right">
						          <div class="circle"></div>
						        </div>
						      </div>

						      <div class="spinner-layer spinner-red">
						        <div class="circle-clipper left">
						          <div class="circle"></div>
						        </div><div class="gap-patch">
						          <div class="circle"></div>
						        </div><div class="circle-clipper right">
						          <div class="circle"></div>
						        </div>
						      </div>

						      <div class="spinner-layer spinner-yellow">
						        <div class="circle-clipper left">
						          <div class="circle"></div>
						        </div><div class="gap-patch">
						          <div class="circle"></div>
						        </div><div class="circle-clipper right">
						          <div class="circle"></div>
						        </div>
						      </div>

						      <div class="spinner-layer spinner-green">
						        <div class="circle-clipper left">
						          <div class="circle"></div>
						        </div><div class="gap-patch">
						          <div class="circle"></div>
						        </div><div class="circle-clipper right">
						          <div class="circle"></div>
						        </div>
						      </div>
						    </div>
						    <!-- End Preloader -->
						    <div class="commentBox-Parent">
								@foreach($comments as $comment)
								<div class="commentBox">
									<div class="userImg">
										<a href="{{url('profile/'.$comment->User->id)}}"><img src="{{$comment->User->image}}" alt="{{$comment->User->image}}"></a>
										<p><a href="{{url('profile/'.$comment->User->id)}}">{{$comment->User->nickname}}</a></p>
									</div>
									<div class="Comment">
										<p>{!!$comment->comment!!}</p>
									</div>
									@if (!auth()->guest()&&auth()->user()->id == $comment->User->id)
										<div class="Delete_Edit">
											<a href="javascript:;" url="{{url('deletecomment/'.$comment->id)}}" class="deleteCommentA"><i class="material-icons">clear</i></a>
											<a href="{{url('editcomment/'.$comment->id)}}" class="editCommentA waves-effect waves-teal btn-flat">{{trans('Post.editComment')}}</a>
										</div>
									@endif
								</div>
								@endforeach
							</div>
							<!-- Start Pagination -->
						  	@if (isset($comments))
							    @if ($comments->hasPages())
						        	<script type="text/javascript">
										var previousPage = '{{$comments->previousPageUrl()}}';
										if (document.referrer=="{{url('post/'.$post->id.'?page=1')}}"){
						        			$('.commentDiv').show();
						        		}
						        		else if (previousPage==''){}else{
						        			$('.commentDiv').show();
						        		}
						        	</script>
							        {{$comments->links()}}
							    @endif
						    @endif
						    <!-- End Pagination -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Section Post -->
<!-- Modal Structure Opinions -->
<div id="Modal" class="modal">
	<div class="modal-content">
		<h4>{{session()->get('Title')}}</h4>
		<p>{{session()->get('Message')}}</p>
	</div>
</div>
@if (session()->has('Modal'))
<script type="text/javascript">
	$(document).ready(function(){
		$('#Modal').modal();
		$('#Modal').modal('open');
	});
</script>
@endif
<!-- Modal Structure Delete Comment -->
<div id="deleteCommentModal" class="modal deleteCommentModal">
	<div class="modal-content">
		<h4>{{trans('Post.deleteCommentModalTitle')}}</h4>
		<p>{{trans('Post.deleteCommentModalMessage')}}</p>
	</div>
	<div class="modal-footer">
    	<a href="javascript:;" class="modal-action modal-close waves-effect waves-red btn-flat Yes">{{trans('Post.deleteCommentModalYes')}}</a>
    	<a href="javascript:;" class="modal-action modal-close waves-effect waves-green btn">{{trans('Post.deleteCommentModalNo')}}</a>
    </div>
</div>
@stop