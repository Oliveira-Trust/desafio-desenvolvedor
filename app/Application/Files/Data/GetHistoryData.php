<?php
namespace Application\Files\Data;

use Spatie\LaravelData\Data;

class GetHistoryData extends Data {
    public function __construct(
        public ?string $filename = null,
        public ?string $date = null,
    )
    {}
}
