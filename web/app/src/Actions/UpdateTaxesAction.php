<?php

namespace App\Actions;

use Exception;
use Selene\Request\Request;
use App\Tasks\UpdateTaxesTask;
use App\Exceptions\TaxesGeneralException;

class UpdateTaxesAction
{
    public function run(Request $request): void
    {
        try {
            $data = $request->sanitize([
                'tax1',
                'tax2'
            ]);

            if (empty($data)) {
                throw new TaxesGeneralException();
            }

            (new UpdateTaxesTask)->run($data);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
