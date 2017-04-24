<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Comments;
use App\Opinions_Model;
use Cookie;

class Post extends Controller
{
	public function showPost($id){
		if (auth()->guest()){
			auth()->loginUsingId(1);
		}
		$getComments = Comments::where('post_id',$id)->orderBy('id','desc')->paginate(10);
		$getCountComments = Comments::where('post_id',$id)->count();
		$getPost = Posts::where('id',$id)->first();
		app()->singleton('Title',function() use ($getPost){
			$title = $getPost->title;
			$title .= ' | '.trans('Titles.nameOfSite');
			return $title;
		});
		if (auth()->guest()){
			$getOpinionGuest = Opinions_Model::where('guest_ip',$_SERVER['REMOTE_ADDR'])->where('post_id',$id)->first();
			$Ids = Cookie::get('readed');
			$Ids[] .= $id;
			if (isset($getOpinionGuest) && in_array($id,Cookie::get('readed'))){

			}elseif (isset($getOpinionGuest)){
				if ($getOpinionGuest->guest_ip != $_SERVER['REMOTE_ADDR'] && in_array($id,Cookie::get('readed'))){
					$updateIP = Opinions_Model::find($getOpinionGuest->id);
						$updateIP->guest_ip = $_SERVER['REMOTE_ADDR'];
					$updateIP->save();
				}elseif ($getOpinionGuest->guest_ip == $_SERVER['REMOTE_ADDR'] && !in_array($id,Cookie::get('readed'))) {
					Cookie::queue('readed',$Ids,time() + (10 * 365 * 24 * 60 * 60));
				}
			}elseif (!isset($getOpinionGuest)){
				$addReaded = new Opinions_Model;
					$addReaded->guest_ip = $_SERVER['REMOTE_ADDR'];
					$addReaded->post_id = $id;
					$addReaded->opinion = 'Readed';
				$addReaded->save();
				Cookie::queue('readed',$Ids,time() + (10 * 365 * 24 * 60 * 60));
				$addReadedPost = Posts::find($id);
					$addReadedPost->readed = $getPost->readed + 1;
				$addReadedPost->save();
			}
			return view(app('normal').'.Post',['post'=>$getPost,'comments'=>$getComments,'countComments'=>$getCountComments]);
		}else{
			$getOpinion = Opinions_Model::where('user_id',auth()->user()->id)->where('post_id',$id)->where('notreaded',1)->first();
			$getReadedUser = Opinions_Model::where('user_id',auth()->user()->id)->where('post_id',$id)->where('opinion','Readed')->first();
			if (isset($getReadedUser)){

			}else{
				$addReaded = new Opinions_Model;
					$addReaded->user_id = auth()->user()->id;
					$addReaded->post_id = $id;
					$addReaded->opinion = 'Readed';
				$addReaded->save();
				$addReadedPost = Posts::find($id);
					$addReadedPost->readed = $getPost->readed + 1;
				$addReadedPost->save();
			}
			return view(app('normal').'.Post',['post'=>$getPost,'opinion'=>$getOpinion,'comments'=>$getComments,'countComments'=>$getCountComments]);
		}
	}
}