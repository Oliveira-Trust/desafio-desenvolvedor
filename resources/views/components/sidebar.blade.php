<aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @auth
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (isset(Auth::User()->foto_perfil))
            <img src="{{asset(Auth::User()->foto_perfil)}}" class="img-circle elevation-2" alt="User Image">    
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{strlen(Auth::User()->name)>10?substr(ucwords(Auth::User()->name),0,10).'...':ucwords(Auth::User()->name)}}</a>
        </div>
      </div>    
      @endauth
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              @guest
                <li class="nav-item">
                    <a href="{{route('login')}}" id="menu_entrar" class="nav-link {{Request::route()->getName()=='login'?'active':''}}">
                        <i class="nav-icon fas fa-user" id="img_entrar"></i>
                        <p>
                            Entrar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('register')}}" id="menu_reg_usu" class="nav-link {{Request::route()->getName()=='register'?'active':''}}">
                      <i class="nav-icon fas fa-user" id="img_reg_usu"></i>
                      <p>
                          Cadastrar
                      </p>
                  </a>
                </li>
              @endguest

              @auth
                <li class="nav-item has-treeview {{(Request::route()->getName()=='admin.editUser')
                                                  ||(Request::route()->getName()=='admin.trocarSenha')?'menu-open':''}}">
                    <a href="#" id="menu_minha_conta" class="nav-link {{(Request::route()->getName()=='admin.trocarSenha')
                                                  ||(Request::route()->getName()=='admin.editUser')?'active':''}}">
                        <i class="nav-icon fas fa-user" id="img_minha_conta"></i>
                        <p>
                        Minha Conta
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{route('admin.editUser')}}" id="menu_dados_cadastrais" class="nav-link {{Request::route()->getName()=='admin.editUser'?'active':''}}">
                            <i id="img_dados_cadastrais" class="nav-icon far fa-user"></i>
                            <p>Dados Cadastrais</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a id="menu_senha" href="{{route('admin.trocarSenha')}}" class="nav-link {{Request::route()->getName()=='admin.trocarSenha'?'active':''}}">
                            <i id="img_senha" class="nav-icon far fa-user"></i>
                            <p>Trocar Senha</p>
                        </a>
                        </li>
                    </ul>
                </li>  

                {{-- Negociação --}}
                <li class="nav-item">
                  <a id="menu_trade" href="{{route('admin.trade')}}" class="nav-link {{(Request::route()->getName()=='admin.trade')?'active':''}}">
                      <i id="img_trade" class="far fa-edit nav-icon"></i>
                      <p>
                          Negociação
                      </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a id="menu_sair" class="nav-link" href="#" data-toggle="modal" data-target="#LogoutModal">
                    <i id="img_sair" class="nav-icon far fa-circle text-warning"></i>
                    <p>Sair</p> 
                  </a>
                </li>    
                <br><br><br></div>
              @endauth
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>