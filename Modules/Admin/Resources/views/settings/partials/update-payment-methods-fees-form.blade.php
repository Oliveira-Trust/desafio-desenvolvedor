<div class="card">
    <div class="card-body">
        <div class="card-title"><h4>Taxas de Pagamento (%)</h4></div>
        <form method="POST" action="{{route('admin.updatePaymentMethodsFees')}}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="boleto_fee" class="form-label">Boleto</label>
                <input type="number" max="100" name="boleto" class="form-control" id="boleto_fee" value="{{$boleto_fee}}"
                    required>
                @if ($errors->get('boleto'))
                    @include('components.common.input-errors', ['errors' => $errors->get('boleto')])
                @endif
            </div>

            <div class="mb-3">
                <label for="credit_card_fee" class="form-label">Cartão de Crédito</label>
                <input type="number" max="100" name="credit_card" class="form-control" id="credit_card_fee" value="{{$credit_card_fee}}"
                    required>
                @if ($errors->get('credit_card'))
                    @include('components.common.input-errors', ['errors' => $errors->get('credit_card')])
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            @if (session('status') === 'payment-fees-updated')
                <div class="text-center mt-2">
                    @include('components.common.success-alert', ['successMessage' => 'Taxas de Pagamento Atualizadas'])
                </div>
            @endif
        </form>
    </div>
</div>
