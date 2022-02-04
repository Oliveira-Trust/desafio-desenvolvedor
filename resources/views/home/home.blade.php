@extends('layouts.sb-admin-2.projeto.corpo')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <h1 class="h3 mb-0 text-prsecondaryimary"><i class="fas fa-laugh-wink rotate-n-15 "></i> Bem vindo!!</h1>
</div>
<!-- Content Row -->
<div class="row">

    <div class="card shadow col-lg-12">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Olá <strong>{{ Auth::user()->nome}}</strong></h6>
        </div>
        <div class="card-body">
            <p>
            Nós da 
            <font class="text-dark font-black-ops-one">
            Oliveira Trust
            </font>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu dui volutpat, mollis quam et, tristique magna. Vestibulum sed velit ut quam vestibulum ultrices. Duis efficitur ante vel nulla hendrerit viverra. Morbi sagittis velit non nulla consectetur, vitae blandit metus rhoncus. Suspendisse posuere leo sit amet augue eleifend dapibus. Morbi dui eros, rhoncus consectetur tempus vel, vehicula ut tellus. Pellentesque id bibendum enim, sit amet iaculis ante. Pellentesque sollicitudin volutpat ipsum sit amet finibus. Suspendisse libero dolor, accumsan et arcu id, condimentum facilisis turpis. Suspendisse efficitur scelerisque turpis vel faucibus. In hac habitasse platea dictumst. Cras hendrerit ligula vitae nisl placerat, nec egestas sapien facilisis. Donec sagittis blandit justo, a feugiat tortor varius vel. Curabitur diam sapien, tempor in varius pellentesque, egestas sed turpis. Nam ut finibus enim, feugiat facilisis diam. Donec sodales ante nulla, vel bibendum sapien vulputate ac.s.
        </p>
            <p class="mb-0">Obrigado por nos escolher. <i class="text-dark fas fa-laugh-beam rotate-n-15"></i></p>
        </div>
    </div>

</div>

<!-- Page level plugins -->
<script src="{{asset('sb-admin-2-assets/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
@endsection
