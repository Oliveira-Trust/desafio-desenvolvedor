<?php

Route::group(['prefix' => 'conversion', 'as' => 'conversion::', 'middleware' => ['auth']], static function () {
    Route::get('/', ['as' => 'conversion.index', 'name' => 'Histórico de Conversões', 'uses' => 'ConversionController@index']);
    Route::get('create', ['as' => 'conversion.create', 'name' => 'Conversão de moeda', 'uses' => 'ConversionController@create']);
    Route::get('{conversion}', ['as' => 'conversion.show', 'name' => 'Conversão de moeda', 'uses' => 'ConversionController@show']);
    Route::post('/', ['as' => 'conversion.store', 'uses' => 'ConversionController@store']);

    Route::get('config/payment/edit', ['as' => 'config.payment.edit', 'name' => 'Taxas - Forma de Pagamento', 'uses' => 'ConversionConfigPaymentController@edit']);
    Route::put('config/payment/edit', ['as' => 'config.payment.update', 'uses' => 'ConversionConfigPaymentController@update']);

    Route::get('config/tax', ['as' => 'config.tax.index', 'name' => 'Taxas - Conversão', 'uses' => 'ConversionConfigTaxController@index']);
    Route::get('config/tax/create', ['as' => 'config.tax.create', 'name' => 'Taxas - Conversão', 'uses' => 'ConversionConfigTaxController@create']);
    Route::post('config/tax', ['as' => 'config.tax.store', 'uses' => 'ConversionConfigTaxController@store']);
    Route::get('config/tax/{conversion_tax}/edit', ['as' => 'config.tax.edit', 'name' => 'Forma de Pagamento', 'uses' => 'ConversionConfigTaxController@edit']);
    Route::put('config/tax/{conversion_tax}', ['as' => 'config.tax.update', 'uses' => 'ConversionConfigTaxController@update']);
    Route::get('config/tax/{conversion_tax}/delete', ['as' => 'config.tax.delete', 'uses' => 'ConversionConfigTaxController@delete']);
});
