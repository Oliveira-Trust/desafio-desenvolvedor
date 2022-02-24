<x-layout type="pagamento">

    <div class="row">
        <div class="col">
            <h1>Cadastro de Forma de Pagamento:</h1>
        </div>
    </div>

    <div class="row bd-example">
        <div class="col">
            <form method="POST" action="{{ route('formas.pag.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nome:</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="" name="nome" value="{{ old('nome') }}">

                    @error('nome')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Taxa:</label>
                    <input type="number" class="form-control @error('taxa') is-invalid @enderror" placeholder="" name="taxa" value="{{ old('taxa') }}">

                    @error('taxa')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a type="button" href="{{ route('formas.pags') }}" class="btn btn-secondary">Voltar para Listagem</a>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>

            </form>
        </div>
    </div>

</x-layout>
