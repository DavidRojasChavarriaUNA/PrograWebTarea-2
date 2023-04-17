<?php
    Route::get('/', 'WelcomeController@index');
    /*Route::get('books', 'BooksController@index');
    Route::get('books/(:number)', 'BooksController@show');
    Route::get('authors', 'AuthorsController@index');
    Route::get('authors/(:number)', 'AuthorsController@show');
    Route::get('publishers', 'PublishersController@index');
    Route::get('publishers/(:number)', 'PublishersController@show');*/
    Route::resource('books', 'BooksController');
    Route::get('books/(:number)/delete','BooksController@destroy');
    Route::resource('authors', 'AuthorsController');
    Route::get('authors/(:number)/delete','AuthorsController@destroy');
    Route::resource('publishers', 'PublishersController');
    Route::get('publishers/(:number)/delete','PublishersController@destroy');
    Route::dispatch();
?>
