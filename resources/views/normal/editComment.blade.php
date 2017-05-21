@extends(app('normal').'.Index')
@section('center')
{!! Html::script(app('js').'/tinymce/tinymce.min.js') !!}
{!! Html::script(app('js').'/ConTinyMce.min.js') !!}
<!-- Start Section Edit Comment -->
<section class="editComment">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="editCommentDiv">
					<textarea id="editComment" class="materialize-textarea" name="editComment"></textarea>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
						id = 'editComment';
						tinymce.get('editComment').setContent('{{$getComment}}');
					</script>
<!-- End Section Edit Comment -->
@stop