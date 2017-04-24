<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Opinions_Model;

class Opinions extends Controller
{
	public function Like($id){
		session()->flash('Modal',true);
		$getPost = Posts::where('id',$id)->first();
		$updatePost = Posts::find($id);
		$getLike = Opinions_Model::where('user_id',auth()->user()->id)->where('post_id',$id)->where('opinion','Like')->first();
		if (isset($getLike)){
			$deleteOpinion = Opinions_Model::where('id',$getLike->id)->delete();
			$updatePost->likes = $getPost->likes - 1;
			$updatePost->save();
			session()->flash('Title',trans('Post.opinionTitle'));
			session()->flash('Message',trans('Post.deleteLikeMessage'));
			return redirect()->back();
		}else{
			$deleteDeslikeOpinion = Opinions_Model::where('opinion','Deslike')->where('user_id',auth()->user()->id)->where('post_id',$id)->delete();
			$addOpinion = new Opinions_Model;
				$addOpinion->user_id = auth()->user()->id;
				$addOpinion->post_id = $id;
				$addOpinion->notreaded = 1;
				$addOpinion->opinion = 'Like';
			$addOpinion->save();
			$updatePost->likes = $getPost->likes + 1;
			$updatePost->save();
			session()->flash('Title',trans('Post.opinionTitle'));
			session()->flash('Message',trans('Post.likeMessage'));
			return redirect()->back();
		}
	}
	public function Deslike($id){
		session()->flash('Modal',true);
		$getPost = Posts::where('id',$id)->first();
		$updatePost = Posts::find($id);
		$getDeslike = Opinions_Model::where('user_id',auth()->user()->id)->where('post_id',$id)->where('opinion','Deslike')->first();
		if (isset($getDeslike)){
			$deleteOpinion = Opinions_Model::where('id',$getDeslike->id)->delete();
			$updatePost->dislikes = $getPost->dislikes - 1;
			$updatePost->save();
			session()->flash('Title',trans('Post.opinionTitle'));
			session()->flash('Message',trans('Post.deleteDeslikeMessage'));
			return redirect()->back();
		}else{
			$deleteLikeOpinion = Opinions_Model::where('opinion','Like')->where('user_id',auth()->user()->id)->where('post_id',$id)->delete();
			$addOpinion = new Opinions_Model;
				$addOpinion->user_id = auth()->user()->id;
				$addOpinion->post_id = $id;
				$addOpinion->notreaded = 1;
				$addOpinion->opinion = 'Deslike';
			$addOpinion->save();
			$updatePost->dislikes = $getPost->dislikes + 1;
			$updatePost->save();
			session()->flash('Title',trans('Post.opinionTitle'));
			session()->flash('Message',trans('Post.desikeMessage'));
			return redirect()->back();
		}
	}
}