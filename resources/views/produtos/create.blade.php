@extends('welcome')

@section('content')

<div class="container">
  <main>
  
    <div class="row g-5">
      
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Cadastro Produtos</h4>
        <form action="{{ route('registrar_produto')}}" method="POST">
       @csrf
          <div class="row g-3">
            <div class="col-sm-12">
              <label for="nome_produto" class="form-label">Nome Produto</label>
              <input type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="" value="" required>
              <div class="invalid-feedback">
                Nome do Produto deve Ser preenchido
              </div>
            </div>

           <div class="col-12">
              <label for="custo_produto" class="form-label">Custo Produto</label>
              <div class="input-group has-validation">
                <span class="input-group-text">R$</span>
                <input type="text" class="form-control" id="custo_produto" name="custo_produto" placeholder="9,99" required>
              <div class="invalid-feedback">
                  O custo deve ser preenchido
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="valor_produto" class="form-label">Valor venda do Produto</label>
              <div class="input-group has-validation">
                <span class="input-group-text">R$</span>
                <input type="text" class="form-control" id="valor_produto" name="valor_produto" placeholder="9,99" required>
              <div class="invalid-feedback">
                  o Valor deve ser preenchido
                </div>
              </div>
            </div>

            

            <div class="col-12">
              <label for="quantidade_produto" class="form-label">Quantidade Produto</label>
              <input type="text" class="form-control" id="quantidade_produto" name="quantidade_produto" placeholder="" required>
              <div class="invalid-feedback">
               Quantidade do produto deve ser preenchida
              </div>
            </div>

     

          <hr class="my-4">


          <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar Produto</button>
        </form>
      </div>
    </div>
  </main>

 
</div>

@endsection
