<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/test', function () {
    return view('test');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//auth for all user types
Route::group(['middleware' => ['auth']], function(){	
    Route::get('/dashboard', 'App\Http\Controllers\ItemController@index')->name('dashboard');
    Route::get('/dashboard/new', 'App\Http\Controllers\ItemController@create')->name('dashboard.new');
    Route::post('/dashboard/new', 'App\Http\Controllers\ItemController@store')->name('dashboard.new');
    Route::get('/dashboard/update/{item}', 'App\Http\Controllers\ItemController@edit')->name('dashboard.update');
    Route::put('/dashboard/edit/{itemid}', 'App\Http\Controllers\ItemController@update')->name('dashboard.edit');
    Route::put('/dashboard/remove/{itemid}', 'App\Http\Controllers\ItemController@destroy')->name('dashboard.remove');
});

//auth for admin
Route::group(['middleware' => ['auth','role:superadministrator']], function(){    
	Route::get('/dashboard/register', 'App\Http\Controllers\DashboardController@create')->name('dashboard.register');
    Route::post('/dashboard/register', 'App\Http\Controllers\Auth\RegisteredUserController@store')->name('dashboard.register');
});


require __DIR__.'/auth.php';
