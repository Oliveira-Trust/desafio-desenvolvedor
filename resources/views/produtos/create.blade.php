<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Novo Produto') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="form" method="POST" action="{{route('salvar_produto')}}">
            @csrf 
            <div class="row">
                <div class="col">
                    <label for="descricao" class="form-label">Descricao</label>
                    <input type="text" class="form-control" id="descricao" name="descricao">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" step="1" class="form-control" id="quantidade" name="quantidade">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="submit" id="btnVoltar" class="btn btn-secondary" onclick="window.location='{{route('produto_index')}}'">Voltar</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("btnVoltar").addEventListener("click", function(event){
            event.preventDefault()
        });
    </script>
</x-app-layout>
