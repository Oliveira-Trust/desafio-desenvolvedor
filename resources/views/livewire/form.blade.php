
<div class="col-md-5" >
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Faça uma nova conversão ;)</h5>
    </div>
    <div class="card-body ">
        <div class="mb-3" >
            <label class="form-label" for="valor-compra">Valor que deseja comprar</label>
            <div class="input-group input-group-merge">
            <span id="valor-compra2" class="input-group-text"><i class="bx bx-money"></i></span>
            <input type="number" class="form-control" id="valor-compra" wire:model.lazy="valorCompra">
            </div>
            <div class="form-text">Em Reais, entre R$1.000,00 e R$100.000,00</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="basic-icon-default-company">Moeda que deseja comprar</label>
            <div class="input-group input-group-merge">
            <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bxs-bank"></i></span>

            <select id="moeda-destino" class="form-select" wire:model="moedaDestino">
                @foreach ($moedas as $moeda)
                    @if ($moeda['sigla'] != 'BRL')
                        <option value="{{$moeda['sigla']}}">{{$moeda['nome']}}</option>
                    @endif
                @endforeach
            </select>
            </div>
        </div>
        <div class="mb-3">
            <small class="text-light fw-semibold d-block">Forma de Pagamento</small>
            @foreach ($formasPagto as $forma)
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" wire:model="formaPagto" value="{{$forma['sigla']}}" checked>
                    <label class="form-check-label" for="inlineRadio1">{{$forma['nome']}}</label>
                </div>
            @endforeach
        </div>
        <div class="mb-3 text-end" >
            <button type="button" class="btn btn-primary" wire:click="calcular()" wire:loading.remove>Comprar</button>
            <div class="spinner-border text-primary" role="status" wire:loading>
                <span class="visually-hidden">Loading...</span>
                </div>
        </div>

    </div>
</div>

<div class="col-md-7" >
    <div class="card-body pb-0 px-0 px-md-4" >
    <img src="../assets/img/exchange-market-color.jpg" height="350" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
    </div>
</div>


