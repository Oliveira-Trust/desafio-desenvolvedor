<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">


            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 w-50">


                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1">
                        <div class="p-6">
                            <h2 class="text-center">Currency Exchanger</h2>
                            <div class="flex items-center">
                                <form action="{{ route('web.exchange') }}" method="post" class="w-100">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Source Currency</label>
                                        <select name="source" required class="form-select" aria-label="Default select example">
                                            <option selected value="BRL">BRL - Real Brasileiro</option>
                                            <option value="USD">USD - Dólar Americano</option>
                                            <option value="EUR">EUR - Euro</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Target Currency</label>
                                        <select name="target" required class="form-select" aria-label="Default select example">
                                            <option selected value=""  disabled>Open this select menu</option>
                                            @foreach($currency_types as $code => $type)
                                                <option value="{{ $code }}">{{$code}} - {{ $type }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Payment Metgod</label>
                                        <select name="method" required class="form-select" aria-label="Default select example">
                                            <option selected value=""  disabled>Open this select menu</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="billet">Billet</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="amount_input" class="form-label">Amount</label>
                                        <input name="amount" type="number" step="0.01" class="form-control" id="amount_input" placeholder="3000.00" min="1000" max="100000">
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>

                            <div class="p-2 mt-4">
                                @isset($result)
                                    <li>Moeda de origem: {{ $result['source_currency'] }}</li>
                                    <li>Moeda de destino: {{ $result['target_currency'] }}</li>
                                    <li>Valor para conversão: {{ $result['source_prefix'] }} {{ $result['source_amount'] }}</li>
                                    <li>Forma de pagamento: {{ ucwords(implode(' ', explode('_', $result['method'])))  }}</li>
                                    <li>Valor da "Moeda de destino" usado para conversão: {{ $result['target_prefix'] }} {{ $result['target_value'] }}</li>
                                    <li>Valor comprado em "Moeda de destino": {{ $result['target_prefix'] }} {{ $result['target_total'] }}</li>
                                    <li>Taxa de pagamento: {{ $result['source_prefix'] }} {{ $result['payment_tax'] }}</li>
                                    <li>Taxa de conversão: {{ $result['source_prefix'] }} {{ $result['exchange_tax'] }}</li>
                                    <li>Valor utilizado para conversão descontando as taxas: {{ $result['source_prefix'] }} {{ $result['target_amount'] }}</li>
                                @endif
                            </div>
                            <hr>
                            <div class="p-2 mt-4">
                               <h2 class="text-center">API Usage</h2>
                                <div class="mb-1">
                                    <code>[POST] /api/exchange</code>
                                </div>
                                <code><pre>{"source": "EUR", "target": "BRL", "amount": 15994.50, "method":"billet"}</pre></code>
                                source: origin currency code (optional / default: BRL)<br>
                                target: target currency code <br>
                                amount: amount to convert <br>
                                method: payment method can be credit_card ou billet<br>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
