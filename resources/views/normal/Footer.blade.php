  <!-- Start Pagination -->
  	@if (isset($posts))
	    @if ($posts->hasPages())
	        {!! Html::style(app('css').'/Footer.css') !!}
	        {{$posts->links()}}
	    @endif
    @endif
    <!-- End Pagination -->
  </body>
</html>