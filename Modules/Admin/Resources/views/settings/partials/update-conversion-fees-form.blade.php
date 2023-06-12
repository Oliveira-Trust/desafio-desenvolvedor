<div class="card mt-3">
    <div class="card-body">
        <div class="card-title"><h4>Taxas de Conversão (%)</h4></div>
        <form method="POST" action="{{route('admin.updateConversionFees')}}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="less_than_3000" class="form-label">Abaixo de R$ 3000,00</label>
                <input type="number" max="100" name="less_than_3000" class="form-control" id="less_than_3000" value="{{$less_than_3000}}"
                    required>
                @if ($errors->get('less_than_3000'))
                    @include('components.common.input-errors', ['errors' => $errors->get('less_than_3000')])
                @endif
            </div>

            <div class="mb-3">
                <label for="more_than_3000" class="form-label">Acima de R$ 3000,00</label>
                <input type="number" max="100" name="more_than_3000" class="form-control" id="more_than_3000" value="{{$more_than_3000}}"
                    required>
                @if ($errors->get('more_than_3000'))
                    @include('components.common.input-errors', ['errors' => $errors->get('more_than_3000')])
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            @if (session('status') === 'conversion-fees-updates')
                <div class="text-center mt-2">
                    @include('components.common.success-alert', ['successMessage' => 'Taxas de Conversão Atualizadas'])
                </div>
            @endif
        </form>
    </div>
</div>
