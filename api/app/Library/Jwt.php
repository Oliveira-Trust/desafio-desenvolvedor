<?php

namespace App\Library;

use Domain\User\Models\Users;
use Firebase\JWT\JWT as JJWTF;
use Firebase\JWT\Key;
use Throwable;

class Jwt
{
	public static function validate()
	{
		$authorization = $_SERVER['HTTP_AUTHORIZATION'];
		$key = $_ENV['JWT_KEY'];
		
		try {
			$token = str_replace('Bearer ', '', $authorization);

			return JJWTF::decode($token, new Key($key, 'HS256'));
		} catch (Throwable $t) {
			throw new \DomainException($t->getMessage(), 401);
		}
	}

	public static function create(Users $data)
	{
		$key = $_ENV['JWT_KEY'];

		$payload = [
			'exp' => time() + 1800,
			'iat' => time(),
			'data' => $data,
		];

		return JJWTF::encode($payload, $key, 'HS256');
	}
}