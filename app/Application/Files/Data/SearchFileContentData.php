<?php

namespace Application\Files\Data;

use Spatie\LaravelData\Data;

class SearchFileContentData extends Data {
    public function __construct(public string $filenameOrId, public string $s)
    {}
}
