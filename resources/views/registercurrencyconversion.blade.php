<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test') }}
        </h2>
    </x-slot>

    <div class="container">

        <div class="row">
            <div class="offset-3 col-5">

                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <b>Currency Conversion</b>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Enter data for conversion</h5>
                        <p class="card-text"></p>

                        <form id="frmconversion" name="frmconversion" method="GET"
                            action="{{ route('currencyConversion') }}">
                            <div class="input-group mb-3 ">
                                <span class="input-group-text"> BRL </span>
                                <input class="form-control decimal-input" type="text" id="conversion_value"
                                    name="conversion_value" placeholder="Enter the value for conversion"
                                    onclick="clearTextarea()" required />
                            </div>

                            <input class="form-control mb-3" type="text" id="userid"
                                value="{{ Auth::user()->id }}" name="userid" hidden />

                            <label for="target_currency ">Target Currency:</label>
                            <select class="form-select  mb-3" id="target_currencyv" name="target_currency"
                                aria-label="Default select example" required>
                                <option selected></option>
                                <option value="USD">Dollar</option>
                                <option value="EUR">Euro</option>
                            </select>

                            <label for="payment_type">Payment Type:</label>
                            <select class="form-select  mb-3" id="payment_type" name="payment_type"
                                aria-label="Default select example" required>
                                <option selected></option>
                                <option value="1">Boleto</option>
                                <option value="2">Card</option>
                            </select>

                            @if (isset($data))
                            <textarea class="form-control" id="resultfinal" style="overflow:hidden; height: 240px;">
                            Source Currency: {{ $data['source_currency'] }}
                            Target Currency: {{ $data['target_currency'] }}
                            Conversion Value: {{ number_format($data['conversion_value'], 2, ',', '.') }}
                            Payment Type: {{ $data['payment_type'] }}
                            Value Target Currency: {{ number_format($data['value_target_currency'], 2, ',', '.') }}
                            Purchased Value: {{ number_format($data['purchased_value'], 2, ',', '.') }}
                            Value Payment Fee: {{ number_format($data['value_payment_fee'], 2, ',', '.') }}
                            Value Conversion Fee: {{ number_format($data['value_conversion_fee'], 2, ',', '.') }}
                            Value Conversion Deduction Fee: {{ number_format($data['value_conversion_deductiong_fee'], 2, ',', '.') }}
                            </textarea>
                          
                            @endif

                            <button class="btn btn-success mb-3" id="enviar" name="enviar" type="submit">Register
                                Conversion</button><br>

                        </form>


                    </div>
                </div>


            </div>
        </div>

    </div>

</x-app-layout>
