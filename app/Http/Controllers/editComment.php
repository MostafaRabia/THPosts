<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;

class editComment extends Controller
{
	public function Edit(Request $r,$id){
		$getComment = Comments::where('id',$id)->first();
		if ($getComment->user_id==auth()->user()->id){
			$editComment = Comments::find($id);
			$editComment->comment = $r->input('comment');
			$editComment->save();
			return 'edited';
		}else{
			return 'fail';
		}
	}
}