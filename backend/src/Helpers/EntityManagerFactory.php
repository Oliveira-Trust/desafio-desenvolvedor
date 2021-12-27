<?php
declare(strict_types=1);

namespace App\Helpers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */

    public static function getEntityManager(): EntityManagerInterface
    {
        $path = __DIR__ . "/../../";
        if(!function_exists('env')){
            require_once $path . 'functions/env.php';
        }
        $hasProxyDir = env("DIR_PROXY") ? $path. env("DIR_PROXY") : null;
        $srcDir = $path . env("SRC_DIR");
        $environment = env("PRODUCTION") ? false : true;

        $isDevMode = $environment;
        $proxyDir = $hasProxyDir;
        $cache = null;
        $useSimpleAnnotationReader = false;
        
        $configDoctrine = Setup::createAnnotationMetadataConfiguration(
            [$srcDir],
            $isDevMode,
            $proxyDir,
            $cache,
            $useSimpleAnnotationReader);

        $conn = [
            'driver'   => env("DRIVER"),
            'host'   => env("HOST"),
            'dbname'   => env("DBNAME"),
            'user'     => env("USERNAME"),
            'password' => env("PASSWORD"),
        ];
        return EntityManager::create($conn, $configDoctrine);
    }
}