<?php

declare(strict_types=1);

namespace App\Service\Jwt;

class Jwt
{
    private $secret;
    public function __construct($secret_key = null)
    {
        $this->secret = $secret_key?? env('SECRET_KEY_TOKEN');
    }
    public function create($data)
    {
        $header = json_encode(["typ" => "JWT", "alg" => "HS256"]);
        $payload = json_encode($data);
        $hbase = $this->base64url_encode($header);
        $pbase = $this->base64url_encode($payload);
        $signature = hash_hmac("sha256", $hbase . "." . $pbase, $this->secret, true);
        $bsig = $this->base64url_encode($signature);
        return $hbase . "." . $pbase . "." . $bsig;
    }
    public function validate($token)
    {
        $jwt_split = explode(".", $token);
        if (count($jwt_split) != 3) {
            return false;
        }
        $signature = hash_hmac("sha256", $jwt_split[0] . "." . $jwt_split[1], $this->secret, true);
        $bsig = $this->base64url_encode($signature);
        if ($bsig != $jwt_split[2]) {
            return false;
        }
        return json_decode($this->base64url_decode($jwt_split[1]));
    }
    private function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    private function base64url_decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/') . str_repeat('=', 3 - (3 + strlen($data)) % 4));
    }
}
