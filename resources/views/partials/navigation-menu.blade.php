<nav x-data="{ open: false }" class="bg-gray-50 border-b border-gray-100">
  <!-- Primary Navigation Menu -->
  <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
          <div class="flex">
              <!-- Logo -->
              <div class="flex-shrink-0 flex items-center">
                  <a href="/" class="flex items-center font-bold text-xl transition duration-300 ease-in-out transform hover:scale-110">
                    <img src="https://www.oliveiratrust.com.br/wp-content/themes/OliveiraTrust_WP/assets/img/logotipo_padrao_grey.svg" width="200" alt="Oliveira Trust">
                  </a>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                  <x-menu.nav-link href="/" :active="request()->routeIs(['home'])">
                      {{ __('Início') }}
                  </x-menu.nav-link>

                  <x-menu.nav-link href="{{ route('currency-quotes') }}" :active="request()->routeIs(['currency-quotes'])">
                      {{ __('Histórico de cotações') }}
                  </x-menu.nav-link>
              </div>
          </div>
          
          @if (Auth::check())
          <!-- Settings Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ml-6">
              <x-jet-dropdown align="right" width="48">
                  <x-slot name="trigger">
                      @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                          <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                              <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                          </button>
                      @else
                          <button class="flex items-center text-sm font-medium text-gray-800 hover:text-red-200 hover:border-gray-300 focus:outline-none focus:text-red-300 focus:border-gray-300 transition duration-150 ease-in-out">
                              <div>{{ Auth::user()->name ?? 'Visitante' }}</div>

                              <div class="ml-1">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                  </svg>
                              </div>
                          </button>
                      @endif
                  </x-slot>

                  <x-slot name="content">
                      <!-- Account Management -->
                      <div class="block px-4 py-2 text-xs text-gray-500">
                          {{ __('Minha Conta') }}
                      </div>

                      <x-jet-dropdown-link href="{{ route('profile.show') }}">
                          {{ __('Perfil') }}
                      </x-jet-dropdown-link>

                      <div class="border-t border-gray-100"></div>

                      <!-- Authentication -->
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <x-jet-dropdown-link href="{{ route('logout') }}"
                                              onclick="event.preventDefault();
                                                          this.closest('form').submit();">
                              {{ __('Sair') }}
                          </x-jet-dropdown-link>
                      </form>
                  </x-slot>
              </x-jet-dropdown>
          </div>
          @else
          <div class="hidden sm:flex sm:items-center sm:ml-6">
              <div class="inline-block">
                  <div class="hidden sm:flex">
                      <x-menu.nav-link href="{{ route('register') }}">
                          {{ __('Criar Conta') }}
                      </x-menu.nav-link>
                  </div>
              </div>
              <div class="inline-block">
                  <div class="hidden sm:-my-px sm:ml-5 sm:flex">
                      <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-600 focus:outline-none focus:border-red-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                          {{ __('Entrar') }}
                      </a>
                  </div>
              </div>
          </div>
          @endif

          <!-- Hamburger -->
          <div class="-mr-2 flex items-center sm:hidden">
              <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                  <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                      <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                      <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
              </button>
          </div>
      </div>
  </div>
  
  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
      @if (Auth::check())
      <div class="pt-2 pb-3 space-y-1">

      </div>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="flex items-center px-4">
              @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                  <div class="flex-shrink-0 mr-3">
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                  </div>
              @endif

              <div>
                  <div class="font-medium text-base text-gray-100">{{ Auth::user()->name }}</div>
                  <div class="font-medium text-sm text-gray-200">{{ Auth::user()->email }}</div>
              </div>
          </div>

          <div class="mt-3 space-y-1">
              <!-- Account Management -->
              <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                  {{ __('Perfil') }}
              </x-jet-responsive-nav-link>

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                  this.closest('form').submit();">
                      {{ __('Sair') }}
                  </x-jet-responsive-nav-link>
              </form>
          </div>
      </div>
      @else
      <div class="pt-2 pb-3 space-y-1">

          <div class="flex justify-around pt-3 pb-0 border-t border-gray-200">
              <a href="{{ route('login') }}" class="py-2 px-5 bg-blue-400 text-gray-800 rounded-lg cursor-pointer hover:bg-blue-300">
                  {{ __('Entrar') }}
              </a>
              <a href="{{ route('register') }}" class="py-2 px-3 bg-red-500 text-gray-800 rounded-lg cursor-pointer hover:bg-red-300">
                  {{ __('Criar Conta') }}
              </a>
          </div>
      </div>
      @endif
  </div>   
  
</nav>
