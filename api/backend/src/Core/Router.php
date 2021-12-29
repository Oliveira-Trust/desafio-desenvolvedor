<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    protected $route_collection;

    public function __construct()
    {
        $this->route_collection = new RouteCollection;
        $this->dispacher = new Dispacher;
    }
    public function get($pattern, $callback)
    {
        $this->route_collection->add('get', $pattern, $callback);
        return $this;
    }
    public function post($pattern, $callback)
    {
        $this->route_collection->add('post', $pattern, $callback);
        return $this;
    }
    public function put($pattern, $callback)
    {
        $this->route_collection->add('put', $pattern, $callback);
        return $this;
    }
    public function delete($pattern, $callback)
    {
        $this->route_collection->add('delete', $pattern, $callback);
        return $this;
    }
    public function find($request_type, $pattern)
    {
        return $this->route_collection->where($request_type, $pattern);
    }
    protected function dispach($route, $params, $request, $container, $namespace = "App\\Http\\Controllers\\")
    {
        return $this->dispacher->dispach($route->callback, $params, $request, $container, $namespace);
    }
    protected function notFound()
    {
        return header("HTTP/1.0 404 Not Found", true, 404);
    }
    public function resolve($request, $container)
    {
        $route = $this->find($request->method(), $request->uri());

        if ($route) {
            $params = $route->callback['values'] ? $this->getValues(substr($request->uri(), 1), $route->callback['values']) : [];
            return $this->dispach($route, $params, $request, $container);
        }
        return $this->notFound();
    }
    protected function getValues($pattern, $positions)
    {
        $result = [];
        $pattern = array_filter(explode('/', $pattern));
        foreach ($pattern as $key => $value) {
            if (in_array($key, $positions)) {
                $result[array_search($key, $positions)] = $value;
            }
        }
        return $result;
    }
    public function translate($name, $params)
    {
        $pattern = $this->route_collection->isThereAnyHow($name);
        if ($pattern) {
            $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $server = $_SERVER['SERVER_NAME'] . '/';
            $uri = [];
            foreach (array_filter(explode('/', $_SERVER['REQUEST_URI'])) as $key => $value) {
                if ($value == 'public') {
                    $uri[] = $value;
                    break;
                }
                $uri[] = $value;
            }
            $uri = implode('/', array_filter($uri)) . '/';
            return $protocol . $server . $uri . $this->route_collection->convert($pattern, $params);
        }
        return false;
    }
}
