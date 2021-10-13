@extends('layout.site')

@section('title', 'Taxas')

@section('conteudo')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Taxas</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Mensagens validação -->
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form name="meusdados" id="meusdados" method="post" action="{{ route('fees.update', $fee->id) }}"
            class="form-horizontal form-label-left input_mask" data-parsley-validate enctype="multipart/form-data">
            {!! method_field('put') !!} <!-- metodo spoofin -->
            {{ csrf_field() }}

            @include('fee._form')

            <div class="col-md12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="form-group">
                            <div align="center" >
                            <button type="submit" class="btn btn-success">Atualizar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<!-- /page content -->
@endsection
