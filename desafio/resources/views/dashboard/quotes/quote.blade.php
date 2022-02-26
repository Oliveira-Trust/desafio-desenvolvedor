@extends('dashboard.templates.app')

@section('title', 'Cotação')

@section('content-dash')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Cotação</h2>
        
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Cotação</span></li>
                </ol>
        
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">FORMULÁRIO DE COTAÇÃO</h2>
                    </header>
                    <div class="panel-body">

                        <form class="form-horizontal form-bordered" id="formQuote">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label class="control-label">MOEDA BASE</label>
                                    <select class="form-control mb-md" name="code" disabled>
                                        <option>BRL</option>
                                    </select>
                                </div>

                                <div class="col-md-2 i-group">
                                    <label class="control-label">MOEDA DESTINO *</label>
                                    <select class="form-control" name="codein" required autofocus>
                                        <option value="">--</option>
                                        @foreach (\App\Models\Coin::all() as $coin)
                                            <option value="{{ $coin->acronym }}">{{ $coin->acronym }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 i-group">
                                    <label class="control-label">VALOR COTAÇÃO *</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="text" id="money" name="conversion_value" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-3 i-group">
                                    <label class="control-label">FORMA DE PAGAMENTO *</label>
                                    <select class="form-control" name="payment_method" required>
                                        <option value="">--</option>
                                        @foreach (\App\Models\PaymentMethod::all() as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label">&nbsp;</label>
                                    <button class="btn btn-primary btn-block quote"><i class="fa fa-send"></i> COTAR</button>
                                </div>
                            </div>
                        </form>

                        <div id="detail"></div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent

    <script src="/assets/javascripts/plugins/mask-money/jquery.maskMoney.min.js"></script>
    <script src="/assets/javascripts/plugins/jquery-validate/jquery.validate.min.js"></script>
    <script src="/assets/javascripts/plugins/jquery-validate/localization/messages_pt_BR.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/assets/javascripts/ajax/quote.js"></script>
@endsection