<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use \App\Libraries\OAuth;
use \OAuth2\Request;
use \OAuth2\Response;

class OAuthFilter implements FilterInterface {
  public function before(RequestInterface $request, $arguments = null) {
    $oauth = new OAuth();
    $req = Request::createFromGlobals();
    $res = new Response();

    if (!$oauth->server->verifyResourceRequest($req)) {
      $oauth->server->getResponse()->send();
      die();
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    // Do something here
  }
}