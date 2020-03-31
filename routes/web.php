<?php


Route::group( [ 'as' => 'auth.', 'prefix' => 'auth' ], function () {

    Route::get('/'       , 'AuthController@index' )->name('index');
    Route::post('/verify', 'AuthController@auth' )->name('auth');
    Route::get('/logoff' , 'AuthController@logoff' )->name('logoff');

});

Route::group( [ 'middleware' => [ 'verify.session', 'dependency.files' ] ], function () {

    Route::get('/', 'MainController@index' )->name('main');

    Route::group( [ 'as' => 'catalog.', 'prefix' => 'catalog' ], function () {

        Route::get('/'          , 'CatalogController@index' )->name('index');
        Route::get('/new'       , 'CatalogController@new' )->name('new');
        Route::get('/edit/{sku}', 'CatalogController@edit' )->name('edit');

    });

    Route::group( [ 'as' => 'customer.', 'prefix' => 'customer' ], function () {

        Route::get('/'         , 'CustomerController@index' )->name('index');
        Route::get('/new'      , 'CustomerController@new' )->name('new');
        Route::get('/edit/{id}', 'CustomerController@edit' )->name('edit');

    });

    Route::group( [ 'as' => 'order.', 'prefix' => 'order' ], function () {

        Route::get('/'         , 'OrderController@index' )->name('index');
        Route::get('/view/{id}', 'OrderController@edit' )->name('view');
        Route::get('/pdv'      , 'OrderController@pdv' )->name('pdv');

    });

});
