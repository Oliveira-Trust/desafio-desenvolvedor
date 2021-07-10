<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <button type="button" class="btn btn-primary" onclick="window.location='{{route('novo_produto')}}'">Inserir novo produto</button>
        <br>

        @sortablelink('descricao')

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
              <tr>
                <th scope="row">{{$produto->id}}</th>
                <td><a href="{{route('editar_produto',['id' => $produto->id])}}">{{$produto->descricao}}</a></td>
                <td>{{$produto->valor}}</td>
                <td>{{$produto->quantidade}}</td>
                <td><button type="button" class="btn btn-danger" onclick="window.location='{{route('excluir_produto',['id' => $produto->id])}}'">Excluir</button></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="pagination justify-content-center" style="margin-top: 12px;">
            <!--paginacao-->
            {{ $produtos->links() }}
          </div>
    </div>
</x-app-layout>
