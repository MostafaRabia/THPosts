@extends(app('normal').'.Index')
@section('center')
{!! Html::style(app('css').'/Home.css') !!}
<!-- Start Posts -->
<section class="posts-Section">
	<div class='container'>
		<!-- For Large -->
		<div class="row hide-on-med-only">
			@php $i = 0 @endphp
			@foreach ($posts as $post)
			<div class='col l4 s12'>
				<div class="post-Item-Div">
					<div class="card sticky-action">
						<div class="card-image">
							<a href="{{url('post/'.$post->id)}}"><img src="{{app('image')}}/{{$post->image}}" alt="{{$post->image}}"></a>
							<a class="btn-floating halfway-fab waves-effect waves-light red" href="{{url('post/'.$post->id)}}"><i class="material-icons">keyboard_arrow_right</i></a>
						</div>
						<div class="card-content">
							<span class="card-title activator grey-text text-darken-4">{{$post->title}}<i class="material-icons left">more_vert</i></span>
							<p><a href="{{url('profile/'.$post->Authors->id)}}">{{$post->Authors->nickname}}</a></p>
						</div>
						<div class="card-action">
							<a href='{{url("type/".$post->Type->id)}}'>{{$post->Type->hash}}</a>
						</div>
						<div class="card-reveal">
							<span class="card-title grey-text text-darken-4">{{$post->title}}<i class="material-icons left">close</i></span>
							<p>{{str_limit($post->post,150,'...')}}</p>
						</div>
						<div class='watches-Likes-Dislikes-Div card-action'>
							<div class="watches-Div">
								<div class="watches-Icon-Div">
									<i class="material-icons">remove_red_eye</i>
									<p>{{$post->readed}}</p>
								</div>
							</div>
							
							<div class="likes-Div">
								<i class="material-icons">thumb_up</i>
								<p>{{$post->likes}}</p>
							</div>
							<div class="dislikes-Div">
								<i class="material-icons">thumb_down</i>
								<p>{{$post->dislikes}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			@php $i++ @endphp
			@if ($i%3==0)
				<div style="clear:both;"></div>
			@endif
			@endforeach
		</div>
		<!-- For Tablets -->
		<div class="row hide-on-large-only">
			<div class='hide'>{{$i=0}}</div>
			@foreach ($posts as $post)
			<div class='col m6'>
				<div class="post-Item-Div">
					<div class="card sticky-action">
						<div class="card-image">
							<a href="{{url('post/'.$post->id)}}"><img src="{{app('image')}}/{{$post->image}}" alt="{{$post->image}}"></a>
							<a class="btn-floating halfway-fab waves-effect waves-light red" href="{{url('post/'.$post->id)}}"><i class="material-icons">keyboard_arrow_right</i></a>
						</div>
						<div class="card-content">
							<span class="card-title activator grey-text text-darken-4">{{$post->title}}<i class="material-icons left">more_vert</i></span>
							<p><a href="{{$post->Authors->id}}">{{$post->Authors->nickname}}</a></p>
						</div>
						<div class="card-action">
							<a href='{{url("type/".$post->Type->id)}}'>{{$post->Type->hash}}</a>
						</div>
						<div class="card-reveal">
							<span class="card-title grey-text text-darken-4">{{$post->title}}<i class="material-icons left">close</i></span>
							<p>{{str_limit($post->post,150,'...')}}</p>
						</div>
						<div class='watches-Likes-Dislikes-Div card-action'>
							<div class="watches-Div">
								<div class="watches-Icon-Div">
									<i class="material-icons">remove_red_eye</i>
									<p>{{$post->readed}}</p>
								</div>
							</div>
							
							<div class="likes-Div @if ($post->likes>$post->dislikes) Biggest @endif">
								<i class="material-icons">thumb_up</i>
								<p>{{$post->likes}}</p>
							</div>
							<div class="dislikes-Div @if ($post->likes<$post->dislikes) Biggest @endif">
								<i class="material-icons">thumb_down</i>
								<p>{{$post->dislikes}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			@php $i++ @endphp
			@if ($i%2==0)
				<div style="clear:both;"></div>
			@endif
			@endforeach
		</div>
	</div>
</section>
<!-- End Posts -->
@stop