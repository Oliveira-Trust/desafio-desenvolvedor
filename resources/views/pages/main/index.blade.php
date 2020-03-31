@extends('layout')

@section('css')
    <style>
        .value-card-click{cursor: pointer;font-size: 2.5rem !important;}
        .value-card-click i{font-size: 2.5rem !important;}
    </style>
@endsection
@section('content')

    <!-- eCommerce statistic -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content reload-card" id="card-orders">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info value-card-click value-card-orders" data-click="0" data-value="0"><i class="la la-eye" style="opacity: 0.4;"></i></h3>
                                <h6>Vendas do dia</h6>
                            </div>
                            <div>
                                <i class="icon-basket-loaded info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content reload-card" id="amount-sales">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning value-card-click value-amount-sales" data-click="0" data-value="R$0"><i class="la la-eye" style="opacity: 0.4;"></i></h3>
                                <h6>Total vendido</h6>
                            </div>
                            <div>
                                <i class="icon-pie-chart warning font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%"
                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content reload-card" id="paid-sales">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger value-card-click value-paid-sales" data-click="0" data-value="R$0"><i class="la la-eye" style="opacity: 0.4;"></i></h3>
                                <h6>Total pago</h6>
                            </div>
                            <div>
                                <i class="icon-bar-chart danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%"
                                 aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content reload-card" id="tt-new-user">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success value-card-click value-tt-new-user" data-click="0" style="font-size: 2.5rem;"><i class="la la-eye" style="opacity: 0.4;"></i></h3>
                                <h6>Novos clientes</h6>
                            </div>
                            <div>
                                <i class="icon-user-follow success font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ eCommerce statistic -->
@endsection

@section('js')
{{--<script src="../assets/js/main/components.js{{$cdnVersionJSCSS}}"></script>--}}
<script>
    $('.reload-card').trigger('click');
</script>
@endsection
