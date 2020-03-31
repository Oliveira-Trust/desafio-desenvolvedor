@extends('layout')

@section('content')
    <section id="text-alignment">
        <div class="row">
            <div class="col-xl-4 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title info">Informações</h4>
                            <form class="form form-horizontal striped-labels form-bordered">
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput1">Pedido</label>
                                        <div class="col-md-8">
                                            <strong>{{$id}}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput1">Situação</label>
                                        <div class="col-md-8">
                                            <div class="badge
                                                 @if( $status != 'cancelado' )
                                                    @if( $status == 'pago' ) badge-success @else badge-info @endif
                                                    @else badge-danger @endif"
                                            >
                                                {{ $status_label[ $status ]  }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput1">Quando</label>
                                        <div class="col-md-8">
                                            <strong>{{ $created_at  }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title info">Cliente</h4>
                            <form class="form form-horizontal striped-labels form-bordered">
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput1">Nome</label>
                                        <div class="col-md-8">
                                            <strong><a href="{{route('customer.edit', [ $customer_id ])}}">{{$customer_name}}</a></strong>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput1">Telefone</label>
                                        <div class="col-md-8">
                                            <strong>{{mask_string( $customer_phone )}}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput1">E-mail</label>
                                        <div class="col-md-8">
                                            <strong>{{$customer_email}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title info">Itens do pedido</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse open show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>Produtos</th>
                                        <th>Preço <small>R$</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $items AS $item )
                                        <tr>
                                            <td>{!! $item['qty'].'x '.$item['catalog_name'] !!}</td>
                                            <td>{!! $item['price'] !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title info">Total</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse open show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td class="text-right">R$ {{$grand_total}}</td>
                                    </tr>
                                    @if ($discount > 0)
                                        <tr>
                                            <td>Desconto</td>
                                            <td class="pink text-right">(-) R$ {{$discount}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-bold-800">Total</td>
                                        <td class="text-bold-800 text-right"> R$ {{$final_price}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        </div>
    </section>
@endsection