<?php

namespace App\Http\Requests;

use App\Models\Config;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CoinConvertionRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $config = Config::findOrFail(env('CONFIG_ID', 1));

        $configuredPaymentMethods = $this->getConfiguredPaymentMethods($config);

        return [
            'currency' => 'required|in:' . $config->active_currency,
            'convertion_value' => 'required|numeric|between:' . $config->min_value_convertion . ',' . $config->max_value_convertion,
            'payment_method' => 'required|in:' . $configuredPaymentMethods,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * !!!! It only makes sense to request English, if the project looks like this:
     *
     * @return array
     */
    public function messages()
    {
        return [

            // Requireds
            'currency.required' => trans('coin_convertion.currency.required'),
            'convertion_value.required' => trans('coin_convertion.convertion_value.required'),
            'payment_method.required' => trans('coin_convertion.payment_method.required'),

            // In's
            'currency.in' => trans('coin_convertion.currency.in'),
            'payment_method.in' => trans('coin_convertion.payment_method.in'),

            // Between's
            'convertion_value.between' => trans('coin_convertion.convertion_value.between'),

        ];
    }

    /**
    * Get the error messages for the defined validation rules.*
    * @return array
    */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => false
        ], 422));
    }

    /**
     * Get the accpetables payment methods configured in database.[objectconfig]
     */
    private function getConfiguredPaymentMethods(Config $config)
    {
        try {

            /**
             * PaymentMethods - currently > CreditCart:7.63% && Ticket:1.45%
             *
             * is necessary add Rate to payment method...
             *
             * example to store: "credit-card:7.63,ticket:1.45"
             *
             * if to need add another payment method [example: debit-card], override this to: "credit-card:1.5,ticket:2.3,debit-card:1" {
             *      in this example...
             *      > credit-card has rate of 1.5%
             *      > ticket has rate of 2.3%
             *      > debit-card has rate of 1%
             * }
             *
             * paymentMethods == 'x:1,y:2,z:3'
             *
             * need getting an string configured: 'x,y,z'
             *
             * ...
             */

            // Get separated array separated by ",": 'x:1,y:2,z:3' == ['x:1', 'y:2', 'z:3']
            $paymentMethodsArray = explode(',', $config->payment_methods);

            $paymentMethodsConfiguredArray = [];

            // Get first key separated by ":": ['x:1', 'y:2', 'z:3'] => first loop => 'x:1' == ['x', '1'] => getting 'x'
            foreach($paymentMethodsArray as $pma) {
                $paymentMethodsConfiguredArray[] = explode(':', $pma)[0] ?? null;
            }

            // Sorting in string payment methods getted
            $paymentMethodsConfigured = "";
            foreach($paymentMethodsConfiguredArray as $pmca) {
                if($pmca) { // remove errors [null values]
                    $paymentMethodsConfigured .= $pmca . ',';
                }
            }

            // removing last ","
            $paymentMethodsConfigured = substr($paymentMethodsConfigured, 0, -1);

        } catch ( \Exception $e ) {
            return false;
        }

        return $paymentMethodsConfigured;

    }
}
