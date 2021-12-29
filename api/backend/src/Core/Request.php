<?php

declare(strict_types=1);

namespace App\Core;


class Request
{
    protected $files;
    protected $base;
    protected $uri;
    protected $method;
    protected $protocol;
    protected $headers;
    protected $data = [];

    public function __construct()
    {
        $this->base = $_SERVER['REQUEST_URI'];
        $this->uri  = $_SERVER['REQUEST_URI'] ?? '/';
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
        $this->headers = apache_request_headers();
        $this->setData();
        if (count($_FILES) > 0) {
            $this->setFiles();
        }
    }
    protected function setData()
    {
        switch ($this->method) {
            case 'get':
                $this->data = $_GET;
                break;
            case 'post':
            case 'head':
            case 'put':
            case 'delete':
            case 'options':
                $data = !empty($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
                $this->data = $data;
                break;
        }
    }
    protected function sefFiles()
    {
        foreach ($_FILES as $key => $value) {
            $this->files[$key] = $value;
        }
    }
    public function base()
    {
        return $this->base;
    }
    public function uri()
    {
        return $this->uri;
    }
    public function method()
    {
        return $this->method;
    }
    public function all()
    {
        return $this->data();
    }
    public function getBody()
    {
        return $this->data;
    }
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }
    public function __get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
    }
    public function hasFile($key)
    {
        return isset($this->files[$key]);
    }
    public function file($key)
    {
        if (isset($this->files[$key])) {
            return $this->files[$key];
        }
    }
    public function getHeaders()
    {
        return $this->headers;
    }
}
