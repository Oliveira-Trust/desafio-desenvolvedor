@extends('layouts.back.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header bg-dark text-light">
                    {{ __('Order List') }}
                    <button id="open-insert" class="btn btn-light float-right collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseCreate" data-text-open="{{ __('Open Panel') }}"
                        data-text-close="{{ __('Close Panel') }}" aria-expanded="false" aria-controls="collapseCreate">
                        {{ __('Open Panel') }}
                    </button>
                </div>
                <div class="card-body">
                    <div id="collapseCreate" class="card border-info collapse collapsedCustom"
                        data-custom-ref="open-insert">
                        <div class="card-header bg-info text-dark">{{ __('Add') }} {{ __('New') }}
                            {{ __('order.name') }}</div>
                        <div class="card-body">
                            @include('painel.order.form')
                        </div>
                    </div>
                    {{$dataTable->table()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/painel/order/index.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush