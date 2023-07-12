<x-app-layout>

    <div class="container">

        <div class="row">
            <div class="offset-3 col-6">

                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <b>Register Conversion Fee</b>
                    </div>
                    <div class="card-body">

                        <form id="frmpaymentfee name="frmpaymentfee" method="GET"
                            action="{{ route('registerConversionFee') }}">

                            <label for="reference_value">Value Reference:</label>
                            <input class="form-control mb-3 decimal-input" type="text" id="reference_value" name="reference_value"
                                required />

                            <label for="fee_higher_value">Fee Higher Value:</label>
                            <input class="form-control mb-3 decimal-input" type="text" id="fee_higher_value" name="fee_higher_value"
                                required />

                            <label for="fee_lower_value">Fee Lower Value:</label>
                            <input class="form-control mb-3 decimal-input" type="text" id="fee_lower_value" name="fee_lower_value"
                                required />


                            <button class="btn btn-success mb-3" id="register" name="register"
                                type="submit">Register</button><br>
                        </form>

                    </div>
                </div>


            </div>
        </div>

    </div>

</x-app-layout>
