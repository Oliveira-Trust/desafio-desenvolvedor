<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="../assets/img/exchange-market.png" height="100" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                </span>
                <span class="app-brand-text demo text-body fw-bolder">Conversor de moedas</span>
              </a>
            </div>
            <!-- /Logo -->
            <!-- <h5 class="mb-2">Conversor de Moedas! ð°ð¸</h5> -->
            <p class="mb-4">Por favor, informe seu email e senha para logar</p>

            <form class="mb-3" method="POST" action="{{ route('login') }}">
                @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email" value="{{old('email')}}" required autofocus autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Senha</label>
                  <!-- <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                  </a> -->
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    value="12345678"
                    aria-describedby="password"
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
              </div>
            </form>

          </div>
        </div>
        <!-- /Register -->
      </div>

</x-guest-layout>
