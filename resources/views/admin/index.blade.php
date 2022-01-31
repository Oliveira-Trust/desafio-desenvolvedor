@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header h3">
            Configurações de taxas e valores
        </div>
        <div class="card-body">
            <form action="{{route('admin.exchange-purchase-store-setup')}}" method="POST">
                @include('admin.forms.form-purchase-tax-values')
            </form>
        </div>
    </div>

@endsection
