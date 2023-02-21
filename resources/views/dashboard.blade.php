<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Layout Demo -->
        <div class="layout-demo-wrapper">

          <!-- INICIO topo conteudo pagina-->
          <div class="col-lg-8 mb-4 order-0">
            <div class="card">
              <div class="d-flex align-items-end row">
                <div class="col-sm-9">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Bem vindo/a {{auth()->user()->name}}! 🎉 </h5>
                    <p class="mb-4">
                      Faça nova conversão ou visualize as já realizadas ;)
                    </p>
                    <div class="">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="btn btn-sm btn-outline-primary "
                            href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                            Desconectar</a>
                        </form>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 text-center text-sm-left">
                  <div class="card-body pb-0 px-0 px-md-4">
                    <img src="../assets/img/exchange-market.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- FIM topo conteudo pagina-->

          <!-- FORM CALC-->
          <livewire:conversao-moeda />
          <!-- FIM FORM CALC-->

        </div>

        <livewire:historico />

        <!--/ Layout Demo -->
      </div>
</x-app-layout>
