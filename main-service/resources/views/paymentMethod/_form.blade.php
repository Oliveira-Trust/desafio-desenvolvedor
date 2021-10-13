<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ isset($paymentMethod) ? 'Editar' : 'Cadastrar'}} Meio de Pagamento </h2>
                <ul class="nav navbar-right panel_toolbox2">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <!-- Mensagem confirmação evento -->
            @if (session('message'))
                <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('message') }}
                </div>
            @endif
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="method">Meio de Pagamento</label>
                        <input name="method" id="method" value="{{ old('method', $paymentMethod->method ?? '') }}" type="text"
                            class="date-picker form-control col-md-7 col-xs-12" required="required">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">Taxa</label>
                        <input name="fee" id="fee" value="{{ old('NAME', $paymentMethod->fee ?? '') }}" type="text"
                               class="date-picker form-control col-md-7 col-xs-12" required="required">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="1"{{ old('status', $paymentMethod->status ?? '') == '1' ? ' selected' : '' }}>Ativo</option>
                            <option value="0" {{ old('status', $paymentMethod->status ?? '') == '0' ? ' selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                </div>
        </div>
    </div>
</div>
