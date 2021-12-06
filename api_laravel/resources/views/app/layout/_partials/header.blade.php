 <div class="container">
   <header>
      <div id="logo">
         <img src="{{ asset('image/logoipsum-logo-50.svg') }}" alt="">
      </div>
      <ul>
         <li> <a href="{{ route('app.admin') }}">Home</a> </li>
         <li> <a href="{{ route('app.historico.cotacoes')}}">Minhas Cotações</a> </li>
         <li> <a href="">Taxas</a> </li>
      </ul>
      <div class="flex-user">
         <span class="fa fa-user"></span> Olá, {{ session()->get('name') }}

	     <a style="margin-left: 60px" href="{{ route('app.logout') }}">Logout</a>	 
      </div>
   </header>
 </div>
