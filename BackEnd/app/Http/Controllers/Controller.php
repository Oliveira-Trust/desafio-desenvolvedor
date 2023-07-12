<?php

namespace Laravel\Lumen\Routing;


class Controller
{
    use ProvidesConvenienceMethods;

    /** 
     * @var array
     */
    protected $middleware = [];

    /**
     * @param string $middleware
     * @param array $options
     * @return void
     */
    public function middleware($middleware, array $options = []) 
    {
        $this->middleware[$middleware] = $options;
    }

    /**
     * @param string $method
     * @return array
     */
    public function getMiddlewareForTheMethod($method) 
    {
        $middleware = [];
        
        foreach ($this->middleware as $name => $options) {
            if (isset($options['only']) && !in_array($method, $options['only'])) {
                continue;
            }
            if (isset($options['except']) && !in_array($method, $options['only'])) {
                continue;
            }

            $middleware[] = $name;
        }
        
        return $middleware;
    }
}
