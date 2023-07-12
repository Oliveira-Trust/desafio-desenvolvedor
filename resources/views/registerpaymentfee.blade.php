<x-app-layout>

    <div class="container">

        <div class="row">
            <div class="offset-3 col-6">

                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <b>Register Payment Fee</b>
                    </div>

                    <div class="card-body">
                        <form id="frmpaymentfee name="frmpaymentfee" method="GET"
                            action="{{ route('registerPaymentFee') }}">
                            <label for="type">Payment Type:</label>
                            <select class="form-select  mb-3" id="type" name="type"
                                aria-label="Default select example" required>
                                <option selected></option>
                                <option value="1">Boleto</option>
                                <option value="2">Card</option>
                            </select>

                            <label for="fee">Fee:</label>
                            <input class="form-control mb-3 decimal-input" type="text" id="fee" name="fee"
                                required />

                            <button class="btn btn-success mb-3" id="enviar" name="enviar"
                             type="submit">Register</button><br>

                        </form>

                    </div>
                </div>


            </div>
        </div>

    </div>
    
</x-app-layout>
