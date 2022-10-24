<?php

namespace App\Traits;

use PhpParser\Node\Expr\Cast\Object_;

trait TestHelper
{
    public function getPrivateMethod(String $className, String $methodName): object
	{
		$reflector = new \ReflectionClass($className);
		$method = $reflector->getMethod($methodName);
		$method->setAccessible(true);

		return $method;
	}
}
