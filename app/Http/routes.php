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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', 'BookController@getIndex');

Route::get('/books/show/{title?}', 'BookController@getShow');

Route::get('/books/create', 'BookController@getCreate');

Route::post('/books/create', 'BookController@postCreate');
//
// Route::get('/books', function()
// {
//     return 'Here are all the books...';
// });

Route::get('/books/category/{category?}', function ($category = null) {
    if (isset($title))
        return 'Here are all the books in the category of '.$category;
    else
        return 'No category provided.';
});

Route::get('/new', function () {
    $view  = '<form method="POST">';
    $view .= csrf_field(); # This will be explained more later
    $view .= 'Title: <input type="text" name="title">';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;
});

Route::post('/new', function () {
    $input =  Input::all();
    print_r($input);
});

Route::get('/hello', function () {
    echo 'Hello World!', '<br>';
    echo App::environment(), '<br>';
    echo config('app.url'), '<br>';
    echo str_singular('media'), '<br>';
    echo str_plural('medium'), '<br>';
});

Route::get('/debugbar', function () {
    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Practice';
});

Route::get('/rych-random', function () {
    $random = new Rych\Random\Random();
    $random2 = new Random();
    return $random->getRandomString(8).$random2->getRandomString(8);
});

Route::controller('/practice','PracticeController');

if (App::environment('local')) {
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

Route::resource('tag', 'TagController');

Route::get('/debug', function () {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if (config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; color:white; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; color:white; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
