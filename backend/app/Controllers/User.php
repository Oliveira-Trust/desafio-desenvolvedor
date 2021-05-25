<?php

namespace App\Controllers;
use \App\Libraries\OAuth;
use \OAuth2\Request;
use \CodeIgniter\API\ResponseTrait;

class User extends BaseController {
  use ResponseTrait;

  public function login() {
    $oauth = new OAuth();
    $req = new Request();
    $res = $oauth->server->handleTokenRequest($req->createFromGlobals());

    return $this->respond(json_decode($res->getResponseBody()), $res->getStatusCode());
  }
}
