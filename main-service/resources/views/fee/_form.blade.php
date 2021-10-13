<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ isset($fee) ? 'Editar' : 'Cadastrar'}} Taxa </h2>
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
                        <label for="type">Tipo</label>
                        <input name="type" id="type" value="{{ old('type', $fee->type ?? '') }}" type="text"
                            class="date-picker form-control col-md-7 col-xs-12" required="required">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="range">Valor Limite Ex.: 1500</label>
                        <input name="range" id="range" value="{{ old('range', $fee->range ?? '') }}" type="number"
                               step="0.01" class="date-picker form-control col-md-7 col-xs-12" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="less_than">% Taxa P/ Vlr < Limite Ex.: 1.2</label>
                        <input name="less_than" id="less_than" value="{{ old('less_than', $fee->less_than ?? '') }}" step="0.01"
                               type="number" step="0.01" class="date-picker form-control col-md-7 col-xs-12" required="required">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="more_than">% Taxa P/ Vlr > Limite Ex.: 0.5</label>
                        <input name="more_than" id="more_than" value="{{ old('more_than', $fee->more_than ?? '') }}" type="number"
                               step="0.01" class="date-picker form-control col-md-7 col-xs-12" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="description">Descrição</label>
                        <input name="description" id="description" value="{{ old('description', $fee->description ?? '') }}" type="text"
                               class="date-picker form-control col-md-7 col-xs-12" required="required">
                    </div>
                    @if (isset($fee->type))
                    <div class="form-group col-md-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required
                            {{ old('status', $fee->status ?? '') == '1' ? ' disabled' : '' }}>
                            <option value="">Selecione</option>
                            <option value="1"{{ old('status', $fee->status ?? '') == '1' ? ' selected' : '' }}>Ativo</option>
                            <option value="0" {{ old('status', $fee->status ?? '') == '0' ? ' selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                    @endif
                </div>
        </div>
    </div>
</div>
