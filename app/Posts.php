<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Posts extends Authenticatable
{
	protected $table = 'posts';
    protected $fillable = [
        'post', 'title', 'author',
        'type', 'hash', 'image',
        'likes', 'dislikes', 'readed'
    ];
    public function Type(){
    	return $this->belongsTo('App\Types','type');
    }
    public function Authors(){
    	return $this->belongsTo('App\Authors','author');
    }
}
