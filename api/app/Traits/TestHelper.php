<?php

namespace App\Traits;

trait TestHelper
{
    public function getPrivateMethod(String $className, String $methodName) {
		$reflector = new \ReflectionClass($className);
		$method = $reflector->getMethod($methodName);
		$method->setAccessible(true);

		return $method;
	}
}
