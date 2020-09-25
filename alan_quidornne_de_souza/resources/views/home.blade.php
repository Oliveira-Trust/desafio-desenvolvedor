@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
       <div class="header-body">
          <div class="row align-items-center py-4">
             <div class="col-lg-6 col-7">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                   <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item"><a href=" {{ route('home') }} "><i class="fas fa-home"></i></a></li>
                      <li class="breadcrumb-item active">Dashboards</li>
                   </ol>
                </nav>
             </div>
          </div>
          <!-- Card stats -->
          <div class="row">
             <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                   <!-- Card body -->
                   <div class="card-body">
                      <div class="row">
                         <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total pedidos</h5>
                            <span class="h2 font-weight-bold mb-0"> {{ $totalPedidos }} </span>
                         </div>
                         <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                               <i class="ni ni-cart text-white"></i>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-xl-4 col-md-6">
               <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                     <div class="row">
                        <div class="col">
                           <h5 class="card-title text-uppercase text-muted mb-0">Total clientes</h5>
                           <span class="h2 font-weight-bold mb-0"> {{ $totalClientes }} </span>
                        </div>
                        <div class="col-auto">
                           <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                              <i class="ni ni-single-02 text-white"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-md-6">
               <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                     <div class="row">
                        <div class="col">
                           <h5 class="card-title text-uppercase text-muted mb-0">Total produtos</h5>
                           <span class="h2 font-weight-bold mb-0"> {{ $totalProdutos }} </span>
                        </div>
                        <div class="col-auto">
                           <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                              <i class="ni ni-collection text-white"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
       </div>
    </div>
 </div>

@endsection