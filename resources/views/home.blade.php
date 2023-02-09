@extends('layouts.app')

@section('content')
    <input type="hidden" id="email_user_send_email" value="{{ auth()->user()->email }}">
    <input type="hidden" id="name_user_send_email" value="{{ auth()->user()->name }}">
    <input type="hidden" id="user_id" value="{{ auth()->user()->id }}">
    <form class="form">
        <div class="div-form-perso">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Digite o valor</label>
                        <input onfocus="clearBorder(this)" id="purchaseAmount" name="purchase_amount" type="text"
                            class="form-control" id="exampleFormControlInput1" placeholder="Ex: 1.000,00">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Moeda de compra</label>
                    <select onfocus="clearBorder(this)" class="form-select" id="type" name="currency_type"
                        aria-label="Default select example">
                        <option value="0" selected>Selecione a moeda</option>
                        <option value="USD-BRL">USD</option>
                        <option value="EUR-BRL">EUR</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Forma de pagamento</label>
                    <select onfocus="clearBorder(this)" class="form-select" id="paymentMethod" name="payment_method"
                        aria-label="Default select example">
                        <option value="0" selected>Selecione a forma de pagamento</option>
                        <option value="bank_slip">Boleto, taxa de 1,45%</option>
                        <option value="credit_card">Cartão de crédito, taxa de 7,63%</option>
                    </select>
                </div>
            </div>

            <div id="div-notification" class="row">
                <div id="msg" class="col-lg-8 text-center mx-auto">

                </div>
            </div>
            <div id="loading" class="text-center"><i style="color:#FF0000"
                    class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-outline-success">Pagar</button>
                </div>
            </div>
        </div>
    </form>
@endsection
