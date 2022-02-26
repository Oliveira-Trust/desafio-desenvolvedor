Currency Origin: {{$quotationHistory->currency_origin}}<br>
Target Currency: {{$quotationHistory->target_currency}}<br>
Value Origin: {{$quotationHistory->formatvalueToBrl('value_origin')}}<br>
With Discount: {{$quotationHistory->formatvalueToBrl('value_origin_with_discount')}}<br>
Payment method: {{$quotationHistory->payment_method}}<br>
Rate Payment: {{$quotationHistory->formatvalueToBrl('rate_payment')}}<br>
Rate Convert: {{$quotationHistory->formatvalueToBrl('rate_convert')}}<br>
Value Target Currency: {{$quotationHistory->formatvalueToBrl('value_target_currency',$quotationHistory->target_currency)}}<br>
Value Base Convert: {{$quotationHistory->formatvalueToBrl('value_base_convert')}}<br>
