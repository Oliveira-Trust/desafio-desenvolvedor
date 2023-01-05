<?php

namespace Modules\Exchange\Repositories\Contracts;

interface RatesRepositoryInterface
{
    public function list();
    public function updateOrCrate(array $data);
}
