<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Authors extends Authenticatable
{
	protected $table = 'authors';
    protected $fillable = [
        'username', 'password', 'nickname',
        'email', 'facebook', 'google',
        'twitter', 'image', 'admin'
    ];
}
