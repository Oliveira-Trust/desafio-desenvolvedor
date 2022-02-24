<x-layout type="conversao">

    <div class="row">
        <div class="col">
            <h1>Conversão de Moeda:</h1>
        </div>
    </div>

    <div class="row bd-example">
        <div class="col">
            <form method="POST" action="{{ route('conversao.simular') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Moeda Origem:</label>
                    <select class="form-select mb-3" name="moeda_origem" aria-label=".form-select-lg">
                        <option selected value="BRL">Real (BRL)</option>
                    </select>

                    <div id="origemHelp" class="form-text">Somente moeda BRL estão sendo aceita no momento.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Moeda Destino:</label>
                    <select class="form-select mb-3 @error('moeda_destino') is-invalid @enderror" aria-label=".form-select-lg" name="moeda_destino">
                        <option value="0" selected>Selecione a moeda</option>
                        @foreach($moedas as $moeda)
                        <option {{ old('moeda_destino') == $moeda->sigla ? 'selected' : '' }} value="{{ $moeda->sigla }}"> {{ $moeda->nome }} </option>
                        @endforeach
                    </select>

                    <x-alert-valid :data="$moedas" type="primary">
                        Não há moedas cadastradas, <a href="{{ route('moeda.novo') }}">clique aqui</a> para cadastrar uma nova.
                    </x-alert-valid>

                    @error('moeda_destino')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor para conversão:</label>
                    <input type="number" class="form-control @error('valor') is-invalid @enderror" placeholder="R$1000" name="valor" value="{{ old('valor') }}">
                    <div id="valorHelp" class="form-text">Min: 1.000,00 e Max: 100.000,00</div>

                    @error('valor')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Forma de Pagamento:</label>

                    <select class="form-select mb-3 @error('forma_pagamento') is-invalid @enderror" aria-label=".form-select-lg" name="forma_pagamento">
                        <option selected>Selecione a forma de pagamento</option>
                        @foreach($formas as $forma)
                        <option {{ old('forma_pagamento') == $forma->id ? 'selected' : '' }} value="{{ $forma->id }}"> {{ $forma->nome }} </option>
                        @endforeach
                    </select>

                    @error('forma_pagamento')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a type="button" href="{{ route('conversoes') }}" class="btn btn-secondary">Voltar Conversão</a>
                    <button type="submit" class="btn btn-primary">Simular Conversão</button>
                </div>

            </form>
        </div>
    </div>

</x-layout>
