<?php

namespace App\Http\Controllers;

use Socialite;
use App\Authors;

class Login extends Controller
{
	public function redirect($drive){
		return Socialite::driver($drive)->redirect();
	}
	public function callback($driver){
		$providerUser = Socialite::driver($driver)->user();
		$getUser = Authors::where('email',$providerUser->getEmail())->first();
		if (isset($getUser)){
			auth()->loginUsingId($getUser->id);
			return redirect()->back();
		}else{
			$add = new Authors;
				$add->username = $providerUser->getName();
				$add->nickname = $providerUser->getName();
				$add->email = $providerUser->getEmail();
				$add->image = $providerUser->getAvatar();
				$add->facebook = "https://www.facebook.com/".$providerUser->getId();
				$add->admin = 1;
			$add->save();
			auth()->loginUsingId($add->id);
			return redirect()->back();
		}
	}
	public function logOut(){
		auth()->logout();
		return redirect()->back();
	}
}