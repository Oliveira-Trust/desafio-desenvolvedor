<?php

declare(strict_types=1);

namespace App\Service\AppCache;

class Cache 
{
    private $cache;
    private $folderCache;
    
    public function __construct($ext = '.cache' ){
        $rootDir = __DIR__.'/../../../';
        $this->folderCache = $rootDir . 'files-cache';
        $this->extensionCache = $ext;
    }    
    public function setCache(string $name, array $value):bool
    {
        $this->readCache($name);
        $this->cache->$name = $value;
        return $this->saveCache($name);
    }    
    public function getCache(string $name): array
    {
        $this->readCache($name);
        if(isset($this->cache->$name) && !empty($this->cache->$name)){
            return (array) $this->cache->$name;
        } 
        return [];
    }
    public function removeCache(string $name):bool
    {
        $this->readCache($name);
        if(isset($this->cache->$name) && !empty($this->cache->$name)){
            $fileName = $this->folderCache . DIRECTORY_SEPARATOR . $name . $this->extensionCache;
            unlink(realpath($fileName));
            return true;
        }
        return false;
    }
    public function getAllCache(): array
    {
        $content = $this->loadCacheFiles();
        return !empty($content) ? $content : [];
    }
    private function loadCacheFiles(): array
    {
        $path = $this->folderCache;        
        $dir = dir($path);
        $caches = [];
        while($file = $dir->read()){
            $name = explode('.', $file);
            if('.'.$name[1] == $this->extensionCache) {
                array_push($caches, $this->getCache($name[0]));
            }
        }
        $dir->close();
        return $caches;
    }
    private function readCache(string $name):void
    {
        $this->cache = new \stdClass();
        if ( file_exists($this->folderCache . DIRECTORY_SEPARATOR . $name . $this->extensionCache) ) {
            $this->cache->$name = json_decode( file_get_contents($this->folderCache . DIRECTORY_SEPARATOR . $name . $this->extensionCache));
        }
    }
    private function saveCache(string $name):bool
    {
        file_put_contents($this->folderCache . DIRECTORY_SEPARATOR . $name . $this->extensionCache, json_encode($this->cache->$name));
        return true;
    }
}
