<?php

use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

it('expects success on accessing the index page', function() {
    $request = $this->get(route('web.conversion.index', ['Accept' => 'application/json']));

    $request->assertStatus(HttpStatusCode::HTTP_OK);
});

it('expects validation errors', function() {
    $request = $this->post(route('api.conversion.run'), [
        'final_currency' => '',
        'amount_to_convert' => '',
        'payment_method' => ''
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
});

it('expects a amount validation error', function() {
    $request = $this->post(route('api.conversion.run'), [
        'final_currency' => 'USD',
        'amount_to_convert' => 0,
        'payment_method' => 'boleto'
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
});

it('expects to convert successfully the given amount to the given currency', function() {
    $request = $this->post(route('api.conversion.run'), [
        'initial_currency' => 'BRL',
        'final_currency' => 'USD',
        'amount_to_convert' => 1000,
        'payment_method' => 'boleto'
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure(['result']);
});


