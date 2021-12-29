<?php
 
namespace App\Core;
 
final class Route
{
    protected static $router; 
    private function __construct()
    {
    }     
    protected static function getRouter()
    {
        if(empty(self::$router)) {
            self::$router = new Router;
        }
        return self::$router;
    } 
    public static function post($pattern, $callback){
        return self::getRouter()->post($pattern, $callback);
    }     
    public static function get($pattern, $callback){
        return self::getRouter()->get($pattern, $callback);
    } 
    public static function put($pattern, $callback){
        return self::getRouter()->put($pattern, $callback);
    } 
    public static function delete($pattern, $callback){
        return self::getRouter()->delete($pattern, $callback);
    }     
    public static function resolve($pattern, $container)
    {
        return self::getRouter()->resolve($pattern, $container);
    } 
    public static function translate($pattern, $params){
        return self::getRouter()->translate($pattern, $params);
    } 
}