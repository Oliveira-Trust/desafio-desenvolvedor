@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar taxa </div>

                @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Erro</h4>
                    @foreach ($errors->all() as $error)
                        <li class="mb-0">
                            {{ $error }}
                        </li>
                    @endforeach
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-body">
                        {!! Form::model($fee, ['route' => ['fee.update', $fee->id], 'method'=>'PUT']) !!}
                            <div class="row">
                                <div class="col-12 col-md-6 col-sm-12 mt-2">
                                    <div class="form-group">
                                        {!! Form::label('label', 'Tipo de taxa', ['class' => 'control-label']) !!}
                                        {!! Form::text('label', null,  ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'amount' ]) !!}
                                    </div>
                                </div>

                                @if($fee->payment_method)
                                    <div class="col-12 col-md-6 col-sm-12 mt-2">
                                        <div class="form-group">
                                            {!! Form::label('payment_method', 'Tipo de pagamento', ['class' => 'control-label']) !!}
                                            {!! Form::text('payment_method', null,  ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'amount' ]) !!}
                                        </div>
                                    </div>
                                @endif

                                @if($fee->depends_on)
                                    <div class="col-12 col-md-6 col-sm-12 mt-2">
                                        <div class="form-group">
                                            {!! Form::label('depends_on', 'Valor mínimo de compra para desconto', ['class' => 'control-label']) !!}
                                            {!! Form::text('dependsOnWithMask', $fee->depends_on,  ['class' => 'form-control', 'id' => 'dependsOnWithMask',  'onBlur' => 'numberToReal(this)', 'onFocus' => 'zeroField(this)' ]) !!}
                                            {!! Form::hidden('dependsOn', $fee->depends_on, ['required' => 'required', 'id' => 'dependsOn']) !!}
                                            {!! Form::hidden('temp', null, ['required' => 'required', 'id' => 'temp']) !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12 col-md-6 col-sm-12 mt-2">
                                    <div class="form-group">
                                        {{ Form::label('fee', 'Porcentagem', ['class' => 'control-label']) }}
                                        {!! Form::number('fee', null,  ['class' => 'form-control', 'id' => 'depends_on', 'min' => 0.01, 'step' => .01 ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3">
                                    {!! Form::submit('Atualizar taxa', ['class' => 'btn btn-success mr-1 mb-1']) !!}
                                    <a href="{{route('fee.index')}}">
                                        <button type="button" class="btn btn-info mr-1 mb-1">Editar taxas</button>
                                    </a>
                                </div>
                            </div>
                        {!! Form::close()  !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>

    document.addEventListener("DOMContentLoaded", function() {

        var formatter = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL',
        });

        let dependsOnWithMask = document.getElementById('dependsOnWithMask')
        dependsOnWithMask.value = formatter.format(dependsOnWithMask.value)

    });

    var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    });

    function numberToReal(v) {

        if(v.value == '') {
            document.getElementById('dependsOn').value = document.getElementById('temp').value
            document.getElementById('dependsOnWithMask').value = formatter.format(document.getElementById('temp').value)
        }else{
            document.getElementById('dependsOn').value = v.value
            document.getElementById('temp').value = v.value
            document.getElementById('dependsOnWithMask').value = formatter.format(v.value)
        }


    }

    function zeroField(v) {
        document.getElementById('temp').value = document.getElementById('dependsOn').value
        document.getElementById('dependsOn').value = ''
        v.value = ''
    }

    </script>
@endsection
