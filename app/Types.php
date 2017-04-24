<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Types extends Authenticatable
{
	protected $table = 'types';
    protected $fillable = [
        'type', 'hash'
    ];
}
