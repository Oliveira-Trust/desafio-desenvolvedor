<div class="col-md-5">
    <div class="card-body pb-0 px-0 px-md-4">
        <img src="../assets/img/exchange-market-color.jpg" height="350" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
    </div>
</div>
<div class="col-md-7">
    <div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
        <h5 class="m-0 me-2">Conversão realizada</h5>
        <small class="text-muted"><i class='bx bx-mail-send' ></i>Foi enviada uma cópia para seu email ;)</small>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-end row">
        <div class="col-8">
            <div class="card-body">
            <h2 class="mb-2 text-success">{{round($resultadoConversao['valorConvertido'], 2)}}</h2>
            <span class="fw-bold">{{$resultadoConversao['destino']}}</span>
            </div>
        </div>
        <div class="col-4 pt-3 ps-0">
            <img src="../assets/img/illustrations/prize-light.png" width="90" height="140" class="rounded-start" alt="View Sales">
        </div>
        </div>

        <ul class="p-0 m-0 mt-4">
        <li class="d-flex mb-2 pb-1">
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
                <h6 class="mb-0">Taxa forma de pagamento</h6>
                <small class="text-muted d-block mb-1">{{$resultadoConversao['nomeFormaPagamento']}}</small>
            </div>
            <div class="user-progress d-flex align-items-center gap-1">
                <span class="fw-bold text-danger">- R$ {{number_format($resultadoConversao['taxaPagamento'],2,",",".")}}</span>
            </div>
            </div>
        </li>
        <li class="d-flex mb-2 pb-1">
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
                <h6 class="mb-0">Taxa de conversão</h6>
                <small class="text-muted d-block mb-1">{{round($resultadoConversao['percentualTaxaConversao'],2)}}%</small>
            </div>
            <div class="user-progress d-flex align-items-center gap-1">
                <span class="fw-bold text-danger">- R$ {{number_format($resultadoConversao['taxaConversao'],2,",",".")}}</span>
            </div>
            </div>
        </li>
        <li class="d-flex mb-2 pb-1">
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
                <h6 class="mb-0">Saldo usado para conversão</h6>
                <small class="text-muted d-block mb-1">Descontado as taxas</small>
            </div>
            <div class="user-progress d-flex align-items-center gap-1">
                <span class="fw-bold">= R$ {{number_format($resultadoConversao['saldoParaConversao'],2,",",".")}}</span>
            </div>
            </div>
        </li>
        <li class="d-flex mb-2 pb-1">
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
                <h6 class="mb-0 text-warning">Cotação da moeda</h6>
                <small class="text-muted d-block mb-1">Em reais</small>
            </div>
            <div class="user-progress d-flex align-items-center gap-1">
                <span class="fw-bold text-warning">R$ {{number_format($resultadoConversao['valorCotacao'],2,",",".")}}</span>
            </div>
            </div>
        </li>

        </ul>
        <div class="text-center">
            <button type="button" class="btn btn-sm btn-outline-primary" wire:click="novaConversao()" wire:loading.remove>Nova conversão</button>
        </div>
    </div>
    </div>
<!--/ Order Statistics -->

</div>
