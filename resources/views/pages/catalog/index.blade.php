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
                <div class="card-header reload-card" id="last-orders">
                    <h4 class="card-title">
                        <strong>Selecione:</strong>
                        <span class="check cursor-pointer" data-action="1">Todos Visíveis</span> |
                        <span class="check cursor-pointer" data-action="0">Desselecionar</span> |
                        <strong class="tt">0</strong> itens selecionados
                        <button class="btn btn-sm btn-list_ids btn-warning" data-destiny="catalog">Deletar</button>
                    </h4>
                    <div class="heading-elements">
                        <button onclick="location.href='{{route('catalog.new')}}'" class="btn btn-primary btn-sm btn-icon"><i class="ft-plus white"></i> Novo</button>
                        <span class="dropdown"></span>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div id="last-orders" class="media-list position-relative">
                        <div class="table-responsive">
                            <table class="table table-hover table-xl mb-0">
                                <thead>
                                <tr>
                                    <th class="border-top-0" style="width: 5%">#</th>
                                    <th class="border-top-0">Nome {!! format_hmt_sort( 'name', $filters ) !!}</th>
                                    <th class="border-top-0">SKU {!! format_hmt_sort( 'sku', $filters ) !!}</th>
                                    <th class="border-top-0">Preço {!! format_hmt_sort( 'price', $filters ) !!}</th>
                                    <th class="border-top-0">Status {!! format_hmt_sort( 'status', $filters ) !!}</th>
                                    <th class="border-top-0 text-right">Ação</th>
                                </tr>
                                </thead>
                                <tbody class="value-last-orders">
                                @foreach( $results AS $row )
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_ids" class="form-control list_ids" value="{{$row['id']}}" />
                                        </td>
                                        <td class="text-truncate">
                                            <a href="{{route('catalog.edit',[$row['sku']])}}">
                                                {{$row['name']}}
                                            </a>
                                        </td>
                                        <td class="text-truncate">{{$row['sku']}}</td>
                                        <td class="text-truncate">R$ {{$row['price']}}</td>
                                        <td class="text-truncate">{!! get_label_bool($row['status'], true) !!}</td>
                                        <td class="text-truncate text-right">
                                            <a class="btn-delete" data-id="{{$row['sku']}}"><i class="la la-trash"></i></a>
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
        cruds.bindDelete('catalog');
        @include('includes.filter-js')
        @include('includes.js-checkbox')
    </script>
@endsection
