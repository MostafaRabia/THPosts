<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class sortsBy extends Authenticatable
{
	protected $table = 'sortsBy';
    protected $fillable = [
        'sortByEnglish', 'sortByArabic',
        'sortByRoutes', 'Sql'
    ];
}
