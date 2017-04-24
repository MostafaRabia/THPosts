<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Opinions_Model extends Authenticatable
{
	protected $table = 'opinions';
    protected $fillable = [
        'user_id', 'post_id', 'notreaded',
        'opinion'
    ];
}
