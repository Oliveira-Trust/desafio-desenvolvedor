<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeeRuleUpdateRequest;
use App\Models\FeeRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class FeeRuleController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function updateFeeRule(FeeRuleUpdateRequest $request): RedirectResponse
    {
        foreach ($request->input('rules') as $fee) {
            $feeRule = FeeRule::find($fee['id']);
            $feeRule->value = $request->input('base_value');
            $feeRule->fee = $fee['fee'];
            $feeRule->save();
        }
        return Redirect::route('settings.edit')->with('status', 'fee-rules-updated');
    }
}
