<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Authors;

class Profile extends Controller
{
	public function Show($id){
		$getAuthor = Authors::where('id',$id)->first();
		app()->singleton('Profile',function() use ($id,$getAuthor){
			$Information = [
				'id' => $id.'Profile',
				'name' => $getAuthor->username
			];
			return $Information;
		});
		app()->singleton('Title',function(){
			return trans('Titles.'.$id.'Profile');
		});
		return view(app('normal').'.Profile',['getAuthor'=>$getAuthor]);
	}
}