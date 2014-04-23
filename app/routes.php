<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => '/', function(){
    return View::make('home')->
        with('title', 'The Foldagram')->with('class', 'home');
}));

Route::get('/about', array('as' => 'about', function(){
    return View::make('about')->
        with('title', 'About Foldagram')->with('class', 'about');
}));

Route::post('/subscribe', array('as' => 'post_subscribe', function(){
    $input = Input::all();
    $rules = array('email' => 'required|email');
    
    $validation = Validator::make($input, $rules);
    
    if($validation->passes()){
        Subscribe::create($input);
        return Redirect::to('/')
            ->with('success', 'Thanks for signing UpFoldagram');
    }
    
    return Redirect::to('/')
        ->withInput()
        ->withErrors($validation)
        ->with('message', 'There were validation errors.');
}));

Route::post('/create', array('as' => 'create', 'uses' => 'FoldagramsController@postCreate'));
Route::get('/remove/{id}/{identifier}', 
    array('as' => 'remove', 'uses' => 'FoldagramsController@removeAddress'));