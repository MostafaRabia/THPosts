<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\sortsBy;
use Illuminate\Support\Facades\Route;

class sortBy extends Controller
{
	public function Home(){
		$Sql = sortsBy::where('sortByRoutes',Route::currentRouteName())->first();
		$Posts = Posts::orderBy($Sql->Sql,'desc')->paginate(36);
		app()->singleton('Title',function(){
			return trans('Titles.'.Route::currentRouteName());
		});
		return view(app('normal').'.Home',['posts'=>$Posts]);
	}
}