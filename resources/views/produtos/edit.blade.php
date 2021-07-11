<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produto') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form class="row g-3" method="POST" action="{{route('atualizar_produto',['id' => $produto->id])}}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="descricao" name="descricao" value="{{$produto->descricao}}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control ls-mask-money" id="valor" name="valor" value="{{$produto->valor}}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" step="1" class="form-control" id="quantidade" name="quantidade" value="{{$produto->quantidade}}">
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
        $(document).ready(function(){
            $('.ls-mask-money').mask('000.000.000.000.000,00', {reverse: true});
        });

        document.getElementById("btnVoltar").addEventListener("click", function(event){
            event.preventDefault()
        });
    </script>
</x-app-layout>
