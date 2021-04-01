@extends('welcome')

@section('content')

<div class="container">
  <main>
  
    <div class="row g-5">
      
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Cadastro Clientes</h4>
        <form action="{{ route('registrar_cliente')}}" method="POST">
       @csrf
          <div class="row g-3">
            <div class="col-sm-12">
              <label for="nome_cliente" class="form-label">Nome Cliente</label>
              <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" placeholder="" value="" required>
              <div class="invalid-feedback">
                Nome do Produto deve Ser preenchido
              </div>
            </div>

            <div class="col-12">
              <label for="endereco" class="form-label">Endereco Cliente</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="endereco" name="endereco"  required>
              <div class="invalid-feedback">
                  o Valor deve ser preenchido
                </div>
              </div>
            </div>

            
		 <div class="col-3">
              <label for="cnpj" class="form-label">CNPJ</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="cnpj" name="cnpj"  required>
              <div class="invalid-feedback">
                  O custo deve ser preenchido
                </div>
              </div>
            </div>
            <div class="col-3">
              <label for="cep" class="form-label">Cep</label>
              <input type="text" class="form-control" id="cep" name="cep" placeholder="" required>
              <div class="invalid-feedback">
               Quantidade do produto deve ser preenchida
              </div>
            </div>
            
            <div class="col-3">
              <label for="uf" class="form-label">UF</label>
              <input type="text" class="form-control" id="uf" name="uf" placeholder="" required>
              <div class="invalid-feedback">
               Quantidade do produto deve ser preenchida
              </div>
            </div>

     

          <hr class="my-4">

 			<div class="col-8">
             <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar Cliente</button>
            </div>
          
        </form>
      </div>
    </div>
  </main>

 
</div>

@endsection
