<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Types;
use App\sortsBy;
use App\Contactus;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Start Array App Singleton */
        $pathsArray = [
            'css'=>url('public/styles/css'),
            'js'=>url('public/styles/js'),
            'image'=>url('public/images'),
            'normal'=>'normal',
            'admin'=>'admin'
        ];
        foreach ($pathsArray as $Name => $Path) {
            app()->singleton($Name,function() use ($Path){
                return $Path;
            });
        }
        /* End Array App Singleton */

        /* Start Types Singleton */
        $getAllTypes = Types::all();
        app()->singleton('Types',function() use ($getAllTypes){
            return $getAllTypes;
        });
        /* End Types Singleton */

        /* Start sortsBy Singleton */
        $getAllSortsBy = sortsBy::all();
        app()->singleton('sortsBy',function() use ($getAllSortsBy){
            return $getAllSortsBy;
        });
        /* End sortsBy Singleton */

        /* Start sortsBy Singleton */
        $getAllContactUs = Contactus::all();
        app()->singleton('Contactus',function() use ($getAllContactUs){
            return $getAllContactUs;
        });
        /* End sortsBy Singleton */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
