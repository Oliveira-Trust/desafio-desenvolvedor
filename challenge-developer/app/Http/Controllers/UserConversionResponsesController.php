<?php

namespace App\Http\Controllers;

use App\Models\UserConversion;

class UserConversionResponsesController extends Controller
{
    public function show()
    {
        $conversionResponses = UserConversion::join('user_conversion_responses', function ($join) {
            $join->on('user_conversions.id', '=', 'user_conversion_responses.user_conversion_id');
        })
        ->where('user_conversions.user_id', auth()->user()->id)
        ->get();

        return inertia('HistoryUserConversions', [
            'conversionResponses' => $conversionResponses,
        ]);
    }
}
