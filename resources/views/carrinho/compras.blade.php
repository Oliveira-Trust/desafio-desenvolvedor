@extends('layout')
@section('pagina_titulo', 'OliveiraStore - Compras' )

@section('pagina_conteudo')

    <div class="container">
        <div class="row">
            <h3>Meus Pedidos</h3>
            @if (Session::has('mensagem-sucesso'))
                <div class="card-panel green">{{ Session::get('mensagem-sucesso') }}</div>
            @endif
            @if (Session::has('mensagem-falha'))
                <div class="card-panel red">{{ Session::get('mensagem-falha') }}</div>
            @endif
            <div class="divider"></div>
            <div class="row col s12 m12 l12">
                <h4>Compras Concluídas</h4>
                @forelse ($compras as $pedido)
                    <h5 class="col l6 s12 m6"> Pedido: {{ $pedido->id }} </h5>
                    <h5 class="col l6 s12 m6"> Realizado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                    <form method="POST" action="{{ route('carrinho.cancelar') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <table>
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total_pedido = 0;
                            @endphp
                            @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                                @php
                                    $total_produto = $pedido_produto->valor;
                                    $total_pedido += $total_produto;
                                @endphp
                                <tr>
                                    <td></td>
                                    <td class="center">
                                        @if($pedido_produto->status == 'PA')
                                            <p class="center">
                                                <input type="checkbox" id="item-{{ $pedido_produto->id }}" name="id[]"
                                                       value="{{ $pedido_produto->id }}"/>
                                                <label for="item-{{ $pedido_produto->id }}">Selecionar</label>
                                            </p>
                                        @else
                                            <strong class="red-text">CANCELADO</strong>
                                        @endif
                                    </td>
                                    <td>{{ $pedido_produto->produto->nome }}</td>
                                    <td>R$ {{ number_format($pedido_produto->valor, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td><strong>Total do Pedido</strong></td>
                                <td>R$ {{ number_format($total_pedido, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn-large red col l12 s12 m12 tooltipped"
                                            data-position="bottom" data-delay="50"
                                            data-tooltip="Cancelar Itens Selecionados">
                                        Cancelar
                                    </button>
                                </td>
                                <td colspan="3"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </form>
                @empty
                    <h5 class="center">
                        @if ($cancelados->count() > 0)
                            Neste Momento Não Há Nenhuma Compra Válida.
                        @else
                            Você Ainda Não Fez Nenhuma Compra.
                        @endif
                    </h5>
                @endforelse
            </div>
            <div class="row col s12 m12 l12">
                <div class="divider"></div>
                <h4>Compras Canceladas</h4>
                @forelse ($cancelados as $pedido)
                    <h5 class="col l2 s12 m2"> Pedido: {{ $pedido->id }} </h5>
                    <h5 class="col l5 s12 m5"> Realizado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                    <h5 class="col l5 s12 m5"> Cancelado em: {{ $pedido->updated_at->format('d/m/Y H:i') }} </h5>
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Produto</th>
                            <th>Valor</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_pedido = 0;
                        @endphp
                        @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                            @php
                                $total_produto = $pedido_produto->valor;
                                $total_pedido += $total_produto;
                            @endphp
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $pedido_produto->produto->nome }}</td>
                                <td>R$ {{ number_format($pedido_produto->valor, 2, ',', '.') }}</td>

                                <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td><strong>Total do Pedido</strong></td>
                            <td>R$ {{ number_format($total_pedido, 2, ',', '.') }}</td>
                        </tr>
                        </tfoot>
                    </table>
                @empty
                    <h5 class="center">Nenhuma Compra Ainda Foi Cancelada.</h5>
                @endforelse
            </div>
        </div>
    </div>
@endsection