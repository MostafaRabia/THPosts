<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{app('Title')}}</title>
    <link rel="shortcut icon" href="{{app('image')}}/icon.png" type="image/png" />
    {!! Html::style('http://fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! Html::style(app('css').'/materialize.min.css') !!}
    {!! Html::style(app('css').'/animate.min.css') !!}
    {!! Html::style(app('css').'/Header.css') !!}
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {!! Html::script(app('js').'/jquery.min.js') !!}
    {!! Html::script(app('js').'/materialize.min.js') !!}
    {!! Html::script(app('js').'/Header.min.js') !!}
    {!! Html::script(app('js').'/materialize-pagination.min.js') !!}
    <style type="text/css">
      /* Start Section Wallpaper */

      .wallpaper-Section{
          width: 100vw;
          height: 100vh;
          background-image: url({{app('image')}}/wallpaper.jpeg);
          background-size: cover;
          position: fixed;
      }
      
      /* End Section Wallpaper */
    </style>
  </head>
  <body>
    <!-- Start Section Loader -->
    <section class='loader-Section' id='loader-Section'>
      <div class="spinner"></div>
    </section>
    <!-- End Section Loader -->

    <!-- Start Section Wallpaper -->
    <section class="wallpaper-Section"></section>
    <!-- End Section Wallpaper -->

    <!-- Start Section Black -->
    <section class="black-Section"></section>
    <!-- End Section Black -->

    <!-- Start Types -->
    <ul id="Types" class="side-nav">
      <li><a href='{{url("/")}}' class="home-Page"><h3>{{trans('Titles.nameOfSite')}}</h3></a></li>
      <div class="input-field">
        {!! Form::open(['url'=>'search','method'=>'get']) !!}
          {!! Form::text('search','',['class'=>'validate']) !!}
          {!! Form::label('search',trans('Header.Search')) !!}
        {!! Form::close() !!}
      </div>
      <li>
      {!! Form::open(['url'=>'sortby','method'=>'get','class'=>'select-Form']) !!}
      <div class="input-field select-SortBy">
        <select>
          <option value="" disabled selected>{{trans('Header.sortBy')}}</option>
          @foreach(app('sortsBy') as $getAllSortsBy)
            <option value="{{trans('Header.'.$getAllSortsBy->sortByEnglish)}}" route='{{url("sortby/".$getAllSortsBy->sortByRoutes)}}'>{{trans('Header.'.$getAllSortsBy->sortByEnglish)}}</option>
          @endforeach
        </select>
      </div>
      {!! Form::close() !!}
      </li>
      <li><a href='{{url("/")}}' class='waves-effect'>{{trans('Header.homePage')}}</a></li>
      @foreach(app('Types') as $type)
        <li><a href='{{url("type/".$type->id)}}' class='waves-effect'>{{$type->type}}</a></li>
      @endforeach
      <li><div class="divider"></div></li>
      <li><a href="javascript:;" class="contactUs">{{trans('Header.contactUs')}}</a>
      @foreach(app('Contactus') as $contactUs)
        <li><a href='{{url($contactUs->link_social)}}' class='waves-effect'>{{$contactUs->name}}</a></li>
      @endforeach
      </li>
    </ul>
    <div class="fixed-action-btn hide-on-med-and-down">
      <a href="javascript:;" data-activates="Types" class="tooltipped show-Types btn-floating btn-large waves-effect waves-light red button-collapse" data-position="top" data-delay="50" data-tooltip="{{trans('Header.Types')}}"><i class="material-icons">format_list_bulleted</i></a>
    </div>
    <i class="material-icons drag-Arrow hide-on-large-only">arrow_back</i>
    <!-- End Types -->