<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use Carbon\Carbon;

class addComment extends Controller
{
	public function Add(Request $r,$id){
		$Add = true;
		if (session()->has('antiSpam')){
			if (session()->has('Time')){
				if (Carbon::now()>=session()->get('Time')){
					session()->forget('antiSpam');
					session()->forget('Time');
				}
			}else{
				$seconds = $r->input('seconds');
				$Carbon = Carbon::now();
				$Time = $Carbon->second($Carbon->second+20);
				session()->put('Time',$Time);
			}
			if (count(session()->get('antiSpam'))>=5){
				$Add = false;
				$timeLeft = Carbon::parse(session()->get('Time'))->diffInSeconds(Carbon::now());
				$Return = [
					'status' => 'Wait',
					'titleMessageWait' => trans('Post.titleMessageWait'),
					'messageWait' => trans('Post.messageWait'),
					'seconds' => abs($timeLeft)
				];
				return $Return;
			}
		}
		if ($Add==true){
			$addComment = new Comments;
				$addComment->post_id = $id;
				$addComment->user_id = auth()->user()->id;
				$addComment->comment = $r->input('comment');
			$addComment->save();
			$antiSpam = session()->get('antiSpam');
			$antiSpam[] .= $id;
			session()->put('antiSpam',$antiSpam);
			$Div = '<div class="commentBox new">';
			$Div .= '<div class="userImg">';
			$Div .= '<a href="'.url('profile/'.auth()->user()->id).'"><img src="'.auth()->user()->image.'" alt="'.auth()->user()->image.'"></a><p><a href="'.url('profile/'.auth()->user()->id).'">'.auth()->user()->nickname.'</a></p>';
			$Div .= '</div>';
			$Div .= '<div class="Comment"><p>'.$r->input('comment').'</p></div>';
			$Div .= '<div class="Delete_Edit"><a href="javascript:;"  url="'.url('deletecomment/'.$addComment->id).'" class="deleteCommentA"><i class="material-icons">clear</i></a><a href="'.url('editcomment/'.$addComment->id).'" class="editCommentA waves-effect waves-teal btn-flat">'.trans('Post.editComment').'</a></div>';
			$Return = ['div'=>$Div,'status'=>'done'];
			return $Return;
		}
	}
	public function Delete($id){
		$getComment = Comments::where('id',$id)->where('user_id',auth()->user()->id)->delete();
		return redirect()->back();
	}
}