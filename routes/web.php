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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');  //->middleware('GuestUser:Hossain Abedy');
Route::get('/services', 'PagesController@services');  //->middleware('GuestUser:Hossain Abedy');
Route::get('/members', 'PagesController@members');


Route::delete('/admin/{id}', 'AdminController@destroy');
Route::put('/admin/{id}/adminedit', 'AdminController@update');
Route::get('/admin/show', 'AdminController@manageuser');
Route::get('/admin/addmember', 'AdminController@managemember');
Route::get('/changerole', 'AdminController@changerole')->name('changerole');
Route::get('/removeuser', 'AdminController@removeuser')->name('removeuser');


Route::resource('members', 'MembersController');
// Route::resource('admin', 'AdminController');
// Route::get('mail', 'Auth\RegisterController@mail')->name('mail');
// Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@send')->name('send');


Route::group(['midlleware'=>['web','auth']], function(){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', function () {
        if(Auth::user()->admin=='user'){
            return view('home');
        }
        else{
            $users['user']=\App\User::all();
            return view('adminhome',$users);
        }
    });
});


