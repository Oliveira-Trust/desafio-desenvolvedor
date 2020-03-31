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
                    <div class="heading-elements">
                        <button onclick="location.href='{{route('customer.new')}}'" class="btn btn-primary btn-sm btn-icon"><i class="ft-plus white"></i> Novo</button>
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
                                    <th class="border-top-0">E-mail {!! format_hmt_sort( 'email', $filters ) !!}</th>
                                    <th class="border-top-0">Documento {!! format_hmt_sort( 'document', $filters ) !!}</th>
                                    <th class="border-top-0">Telefone {!! format_hmt_sort( 'phone', $filters ) !!}</th>
                                    <th class="border-top-0">Status {!! format_hmt_sort( 'status', $filters ) !!}</th>
                                    <th class="border-top-0 text-right">Ação</th>
                                </tr>
                                </thead>
                                <tbody class="value-last-orders">
                                @foreach( $results AS $row )
                                    <tr>
                                        <td class="text-truncate">
                                            <input type="checkbox" name="list_ids" class="form-control list_ids" value="{{$row['id']}}" />
                                        </td>
                                        <td class="text-truncate">
                                            <a href="{{route('customer.edit',[$row['id']])}}">
                                                {{$row['name']}}
                                            </a>
                                        </td>
                                        <td class="text-truncate">{{$row['email']}}</td>
                                        <td class="text-truncate">{{mask_string( $row['document'], 'CPF' )}}</td>
                                        <td class="text-truncate">{{mask_string( $row['phone'] )}}</td>
                                        <td class="text-truncate">{!! get_label_bool($row['status'], true) !!}</td>
                                        <td class="text-truncate text-right">
                                            <a class="btn-delete" data-id="{{$row['id']}}"><i class="la la-trash"></i></a>
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
        cruds.bindDelete('customer');
        @include('includes.filter-js')
        @include('includes.js-checkbox')
    </script>
@endsection
