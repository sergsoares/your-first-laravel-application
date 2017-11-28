<?php

use Illuminate\Http\Request;
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


/*
|--------------------------------------------------------------------------
| Get Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $links = \App\Link::all();

    return view('welcome', ['links' => $links]);
});

Route::get('/submit', function() {
    return view('submit');
});

/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255', 
        'url' => 'required|max:255',
        'description' => 'required|max:255',
    ]);

    $link = tap(new \App\Link($data))->save();

    return redirect('/');
});


/*
|--------------------------------------------------------------------------
| Generic Routes
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
