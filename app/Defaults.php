<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Defaults extends Authenticatable
{
	protected $table = 'defaults';
    protected $fillable = [
        'type', 'properaty', 'data'
    ];
}
