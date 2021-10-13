@extends('layout.site')

@section('title','Home')

@section('conteudo')
<!-- page content -->
<div class="right_col" role="main">
    <!-- CONTENT -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="title_left">
            <h3>Cotações <small></small></h3>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Solicitar Cotação <small> </small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div><br/>
                <!-- Error Messages -->
                @if (session('message'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('message') }}
                    </div>
                @endif
                <!-- Validation Messages -->
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                @endif
                <form name="cotacao" id="cotacao" method="post" action="{{ route('quotation') }}"
                      class="form-horizontal form-label-left input_mask" data-parsley-validate enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @include('home._form')

                    <div class="col-md12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="form-group">
                                    <div align="center" >
                                        <button type="submit" class="btn btn-success">Solicitar Cotação</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> <!-- END-CONTENT -->
</div>
<!-- /page content -->
@endsection
