<?php

namespace Domain\Fees\Actions;

use Domain\Fees\Models\Fees;

final class UpdateFeesAction
{
    public function __invoke(array $data, int $feesId)
    {
        return Fees::find($feesId)->update($data);
    }
}
