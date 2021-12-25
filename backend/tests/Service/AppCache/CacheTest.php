<?php
declare(strict_types=1);

namespace App\Test\Service\AppCache;

use PHPUnit\Framework\TestCase;
use App\Service\AppCache\Cache;

class CacheTest extends TestCase
{
    /**
     * @dataProvider dataProvideToSaveAndGetCache
     */
    public function testShouldCreateACacheFile($nameFileCache, $dataCached)
    {
        $instanceCache = new Cache();
        $instanceCache->setCache($nameFileCache, $dataCached);
        $pathCache = __DIR__.'/../../../files-cache' . DIRECTORY_SEPARATOR . $nameFileCache . '.cache';
        $this->assertFileExists($pathCache);
    }
    /**
     * @dataProvider dataProvideToSaveAndGetCache
     */
    public function testMustReturnTheCacheObject($nameFileCache, $dataCached)
    {
        $instanceCache = new Cache();
        $instanceCache->setCache($nameFileCache, $dataCached);

        $result = $instanceCache->getCache($nameFileCache);
        $this->assertEquals($dataCached, $result);
    }
    public function testShouldGetAllCacheFiles()
    {
        $dataCache = [
            'teste1' => ["teste1"=>"teste1"],
            'teste2' => ["teste2"=>"teste2"],
            'teste3' => ["teste3"=>"teste3"],
            'teste4' => ["teste4"=>"teste4"]
        ];

        $cache = new Cache();
        foreach($dataCache as $key => $value){
            $cache->setCache($key, $value);
        }
        $caches = $cache->getAllCache();
        $this->assertIsArray($caches);
        foreach($dataCache as $key => $value){
            $cache->removeCache($key);
        }
    }
    public function testShouldNotFindTheCacheFile()
    {
        $nameFileCache = 'notExists';
        $instanceCache = new Cache();
        $result = $instanceCache->getCache($nameFileCache);
        $this->assertEquals([], $result);
    }    
    /**
     * @dataProvider dataProviderShouldRemoveCacheFile
     */
    public function testShouldRemoveCacheFile($fileName, $expectedResult)
    {
        $nameFileCache = $fileName;
        $instanceCache = new Cache();               
        $fileRemoved = $instanceCache->removeCache($nameFileCache);
        $this->assertEquals($fileRemoved, $expectedResult);
    }
    public function dataProviderShouldRemoveCacheFile()
    {
        return [
            "ShouldNotRemoveWhenFileNotExists"=>[
                "fileName"=>"notExists",
                "expectedResult" => false],
            "ShouldRemoveWhenFileExists"=>[
                "fileName"=>"teste",
                "expectedResult" => true],
        ];
    }
    public function dataProvideToSaveAndGetCache()
    {
        return [
            "ShouldCreatACacheFile" => [
                "fileName" => "teste", "dataCache" => [
                    "test" => "001",
                    "test2" => "002"
                ]
            ]
        ];
    }
}
