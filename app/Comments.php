<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Comments extends Authenticatable
{
	protected $table = 'comments';
    protected $fillable = [
        'post_id', 'user_id', 'comment'
    ];
    public function User(){
    	return $this->belongsTo('App\Authors');
    }
}
