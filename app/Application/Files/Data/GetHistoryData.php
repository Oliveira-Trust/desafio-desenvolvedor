<?php
namespace Application\Files\Data;

use Spatie\LaravelData\Data;

class GetHistoryData extends Data {
    public function __construct(
        private string $filename,
        private string $date,
    )
    {}
}
