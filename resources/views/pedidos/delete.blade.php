@extends('welcome')

@section('content')
    
<div class="container">
  <main>
  
    <div class="row g-5">
      
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Deletar Produto</h4>
        <form action="{{ route('excluir_produto',['id'=>$produto->id]) }}" method="POST">
       @csrf
          <div class="row g-3">
            <div class="col-sm-12">
              <label for="nome_produto" class="form-label">Tem certeza que deseja deletar esse produto?</label>
              <input type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="" value="{{$produto->nome_produto}}" readonly>
              
            </div>

     

          <hr class="my-4">


          <button class="w-100 btn btn-primary btn-lg" type="submit">Deletar Produto</button>
        </form>
      </div>
    </div>
  </main>

 
</div>
@endsection
