<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','Index@Home');
foreach (app('Types') as $Type) {
	Route::get('/type/'.$Type->id,'Index@Type')->name($Type->id);
}
foreach (app('sortsBy') as $sortsBy) {
	Route::get('/sortby/'.$sortsBy->sortByRoutes,'sortBy@Home')->name($sortsBy->sortByRoutes);
}
Route::get('search','Search@Search');
Route::get('post/{id}','Post@showPost')->where('id','[0-9]+');
Route::group(['middleware'=>'Auth'],function(){
	Route::get('like/{id}','Opinions@Like')->where('id','[0-9]+');
	Route::get('deslike/{id}','Opinions@Deslike')->where('id','[0-9]+');
});
Route::group(['middleware'=>'Guest'],function(){
	Route::get('{drive}/redirect','Login@redirect');
	Route::get('{drive}/callback','Login@callback');
});
Route::get('logout','Login@logOut');
Route::group(['middleware'=>['Comment']],function(){
	Route::post('addcomment/{id}','addComment@Add')->where('id','[0-9]+');
	Route::post('deletecomment/{id}','addComment@Delete')->where('id','[0-9]+');
	Route::post('editcomment/{id}','editComment@Edit')->where('id','[0-9]+');
});
Route::get('profile/{id}','Profile@Show');