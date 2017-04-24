<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Facades\Route;

class Search extends Controller
{
	public function Search(Request $r){
		app()->singleton('Title',function(){
			return trans('Titles.nameOfSite');
		});
		$Posts = Posts::where('title','LIKE','%'.$r->search.'%')->orderBy('id','desc')->paginate(36);
		return view(app('normal').'.Home',['posts'=>$Posts]);
	}
}