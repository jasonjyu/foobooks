<?php

use \Rych\Random\Random;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/books', 'BookController@getIndex');

Route::get('/books/show/{title?}', 'BookController@getShow');
// 
// Route::get('/books', function()
// {
//     return 'Here are all the books...';
// });

Route::get('/books/category/{category?}', function($category = null)
{
    if (isset($title))
        return 'Here are all the books in the category of '.$category;
    else
        return 'No category provided.';
});

Route::get('/new', function()
{
    $view  = '<form method="POST">';
    $view .= csrf_field(); # This will be explained more later
    $view .= 'Title: <input type="text" name="title">';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;
});

Route::post('/new', function()
{
    $input =  Input::all();
    print_r($input);
});

Route::get('/practice', function()
{
    echo 'Hello World!', '<br>';
    echo App::environment(), '<br>';
    echo config('app.url'), '<br>';
});

Route::get('/debugbar', function()
{
    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Practice';
});

Route::get('/rych-random', function()
{
    $random = new Rych\Random\Random();
    $random2 = new Random();
    return $random->getRandomString(8).$random2->getRandomString(8);
});

Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::resource('tag', 'TagController');
