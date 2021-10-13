@extends('layout.site')

@section('title', 'Cadastrar Meio de Pagamento')

@section('conteudo')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Moeda</h3>
                </div>
            <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <form name="meusdados" id="meusdados" method="post" action="{{ route('payment-methods.store') }}"
        class="form-horizontal form-label-left input_mask" data-parsley-validate enctype="multipart/form-data">
        {{ csrf_field() }}

        @include('paymentMethod._form')

        <div class="col-md12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="form-group">
                        <div align="center" >
                        <button type="submit" class="btn btn-success">Cadastrar</button>
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
