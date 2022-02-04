<div class="form-row ">
    <div class="form-group col-md-3">
        <a href="{{ route('conversoes_moedas.adicionar') }}" class=" m-0  btn btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Adicionar Cotação</span>
        </a> 
    </div>
    <div class="form-group col-md-3">
        <a href="{{ route('conversoes_moedas.relatorio') }}" class=" m-0  btn btn-dark btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-file-excel"></i>
            </span>
            <span class="text">Gerar Relatorio</span>
        </a> 
    </div>
    <div class="form-group col-md-6">
        <form id="form-busca-padrao" class="form-inline float-lg-right" action="{{ route('conversoes_moedas.index') }}" method="GET" >
            @csrf
            @method('GET')
            <input type="hidden" id="busca-padrao" name="busca_padrao" value="true" autocomplete="off" >
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" id="busca" name="busca" value="{{ app('request')->input('busca') }}" class="form-control" placeholder="Buscar"  aria-label="Buscar" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-dark" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="input-group mb-2 mr-sm-2">
                <a href="#" class="btn btn-dark btn-icon-split float-lg-right botao-busca-avancada">
                    <span class="icon text-white-50">
                        <i class="fas {{ app('request')->input('busca_avancada') == '' ? 'fa-search-plus' : 'fa-search-minus' }}"></i>
                    </span>
                    <span class="text">Busca Avançada</span>
                </a>
            </div>
        </form>    
    </div>
</div>
<div class="card shadow mb-4 div-busca-avancada {{ app('request')->input('busca_avancada') == '' ? 'hidden' : '' }} ">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Busca Avançada</h6>
    </div>
    <div class="card-body">
    <form id="form-busca-avancada" action="{{ route('conversoes_moedas.index') }}" method="GET" >
        @csrf
        @method('GET')
        <input type="hidden" id="busca-avancada" name="busca_avancada" value="true" autocomplete="off" >
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="moeda_origem">Origem</label>
                <input type="text" id="moeda_origem" name="moeda_origem" value="{{ app('request')->input('moeda_origem') }}" class="form-control"  placeholder="BRL">
            </div>
            <div class="form-group col-md-6">
                <label for="moeda_destino">Destino</label>
                <input type="text" id="moeda_destino" name="moeda_destino" value="{{ app('request')->input('moeda_destino') }}" class="form-control"  placeholder="USD">
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">Buscar</span>
        </button>
        <button type="reset" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-times-circle"></i>
            </span>
            <span class="text">Limpar</span>
        </button>
    </form>   
    </div>
</div>