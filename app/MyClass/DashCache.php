<?php

namespace App\MyClass;

use Danganf\MyClass\AbstractDefaultCache;
use Illuminate\Cache\Repository;

class DashCache extends AbstractDefaultCache
{
    public function __construct(Repository $cache)
    {
        parent::__construct($cache);
        $this->setPrefix(config('dash_'));
    }

}
