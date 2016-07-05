<?php
// Auth::login(App\User::find(1));

Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/books', 'BookController@index');
    Route::get('/books/my', 'BookController@myBooks');
    Route::get('/books/{book}/checkout', 'BookController@checkOut');
    Route::get('/books/{book}/checkin', 'BookController@checkIn');

    Route::get('/books/popular', 'BookController@popular');
});
