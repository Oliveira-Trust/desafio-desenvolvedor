@extends('layout')

@section('css')
    <style>
        .card-title{font-size: 1rem !important;}
        .check{color: #D40000;}
        input[type=checkbox]{cursor: pointer;}
        .btn-list_ids{display: none;position: absolute;margin-top: -4px;margin-left: 4px;}
    </style>
@endsection

@section('content')

    <div class="row">
        @include($basicPath.'.sections.filter')
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header reload-card">
                    <h4 class="card-title">
                        <strong>Selecione:</strong>
                        <span class="check cursor-pointer" data-action="1">Todos Visíveis</span> |
                        <span class="check cursor-pointer" data-action="0">Desselecionar</span> |
                        <strong class="tt">0</strong> itens selecionados
                        <button class="btn btn-sm btn-list_ids btn-warning" data-destiny="customer">Deletar</button>
                    </h4>
                </div>
                <div class="card-content collapse show">
                    <div id="last-orders" class="media-list position-relative">
                        <div class="table-responsive">
                            <table class="table table-hover table-xl mb-0">
                                <thead>
                                <tr>
                                    <th class="border-top-0" style="width: 5%">#</th>
                                    <th class="border-top-0">Cód. {!! format_hmt_sort( 'id', $filters ) !!}</th>
                                    <th class="border-top-0">Produtos</th>
                                    <th class="border-top-0">Cliente nome {!! format_hmt_sort( 'customer_name', $filters ) !!}</th>
                                    <th class="border-top-0">E-mail {!! format_hmt_sort( 'customer_email', $filters ) !!}</th>
                                    <th class="border-top-0">Telefone {!! format_hmt_sort( 'customer_phone', $filters ) !!}</th>
                                    <th class="border-top-0">Valor {!! format_hmt_sort( 'final_price', $filters ) !!}</th>
                                    <th class="border-top-0">Status {!! format_hmt_sort( 'status', $filters ) !!}</th>
                                    <th class="border-top-0">Ação</th>
                                </tr>
                                </thead>
                                <tbody class="value-last-orders">
                                @foreach( $results AS $row )
                                    <tr>
                                        <td class="text-truncate">
                                            <input type="checkbox" name="list_ids" class="form-control list_ids" value="{{$row['id']}}" />
                                        </td>
                                        <td class="text-truncate"><a href="{{route('order.view',[$row['id']])}}">{{$row['id']}}</a></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" style="opacity: 0.8" class="btn btn-icon btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i style="font-size: 1.1em;" class="la la-list-alt"></i> Itens</button>
                                                <div class="dropdown-menu">
                                                    @foreach($row['items'] AS $item)
                                                        <a class="dropdown-item">{{$item['qty'].'x '.$item['catalog_name']}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-truncate"><a href="{{route('customer.edit',[$row['id']])}}">{{$row['customer_name']}}</a></td>
                                        <td class="text-truncate">{{$row['customer_email']}}</td>
                                        <td class="text-truncate">{{mask_string( $row['customer_phone'] )}}</td>
                                        <td class="text-truncate">R$ {{$row['final_price']}}</td>
                                        <td class="text-truncate">{!! array_get( $statusLabel, $row['status'] ) !!}</td>
                                        <td class="">
                                            @if( $row['status'] === 'em_aberto' )
                                            <div class="btn-group">
                                                <button type="button" style="opacity: 0.8" class="btn btn-icon btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i style="font-size: 1.2em;" class="ft-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" style="font-size: 1.1rem;">
                                                    <a class="dropdown-item btn-change-status" data-action="pago" data-text="registrar o pagamento" data-id="{{$row['id']}}"><i class="la la-money"></i> Registrar pagamento</a>
                                                    <a class="dropdown-item btn-change-status" data-action="cancelado" data-text="cancelar" data-id="{{$row['id']}}"><i class="la la-close"></i> Cancelar pedido</a>
                                                    <a class="dropdown-item btn-delete" data-id="{{$row['id']}}"><i class="la la-trash"></i> Deletar</a>
                                                </div>
                                            </div>
                                            @else
                                                <a class="btn-delete" data-id="{{$row['id']}}"><i class="la la-trash"></i> Deletar</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @component('components.paginator', [ 'paginator' => $paginator ] )@endcomponent
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $( document ).ready(function() {
            $('.btn-change-status').on('click',function(){
                let action = $(this).data('action');
                swal({
                    title: 'Deseja realmente '+$(this).data('text')+' desse pedido?',
                    text: "Esta ação não poderá ser desfeita!",
                    confirmButtonText: 'Sim',
                    showCancelButton: true
                }).then((result) => {
                    if ( typeof result.dismiss === "undefined" ) {
                        $('.swal-button--confirm').html(helper.htmlSpinner());
                        $.ajax({
                            url: "/api/put/order/"+$(this).data('id')+"@status@"+action,
                            success: function (data, jqXHR) {
                                helper.alertSucess('Registros atualizado com sucesso!');
                                location.reload();
                            },
                            error: function(data, jqXHR) {
                                helper.alertError(data.responseJSON.error)
                            }
                        });
                    }
                })
            });
        });
        cruds.bindDelete('order');
        @include('includes.filter-js')
        @include('includes.js-checkbox')
    </script>
@endsection
