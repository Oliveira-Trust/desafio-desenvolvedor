<?php

namespace App\Libraries;
use \OAuth2\Storage\Pdo;

class OAuth {
  public $server;

  function __construct() {
    $storage = new Pdo([
      'username' => getenv('database.default.username'),
      'password' => getenv('database.default.password'),
      'dsn'      => getenv('database.default.DSN')
    ]);

    $config = [
      'access_lifetime' => 86400
    ];

    $this->server = new \OAuth2\Server($storage, $config);
    $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage));
  }
}