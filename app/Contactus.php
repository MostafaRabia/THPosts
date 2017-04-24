<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Contactus extends Authenticatable
{
	protected $table = 'contactus';
    protected $fillable = [
        'name', 'link_social'
    ];
}
