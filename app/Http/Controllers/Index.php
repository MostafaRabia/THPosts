<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Facades\Route;

class Index extends Controller
{
	public function Home(){
		app()->singleton('Title',function(){
			return trans('Titles.nameOfSite');
		});
		$Posts = Posts::orderBy('id','desc')->paginate(36);
		return view(app('normal').'.Home',['posts'=>$Posts]);
	}
	public function Type(){
		app()->singleton('Title',function(){
			return trans('Titles.'.Route::currentRouteName());
		});
		$Posts = Posts::where('type',Route::currentRouteName())->orderBy('id','desc')->paginate(36);
		return view(app('normal').'.Home',['posts'=>$Posts]);
	}
}