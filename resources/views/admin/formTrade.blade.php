@extends('layouts.index')

@section('conteudo')
<!--<div class="content-wrapper">-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid animate__animated animate__fadeInUp animate__faster">
        <div class="row">
          <!-- left column -->
          
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            
            
            <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Dados da Negociação</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                      <div class="col-sm-12">
                        <div class="form-group">
                            <form method="post" action="{{ route('admin.trade') }}" onsubmit="this.cadastrar.style.pointerEvents = 'none'; this.cadastrar.textContent = 'Enviando...'">
                                @csrf
                                @if(isset($material))
                                    @method('PUT')
                                @endif
                                 <div class="form-group row">
                                     <label for="name" class="col-md-2 col-form-label text-md-right">Nome</label>
                                     <div class="col-md-10">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="new-password" maxlength="100" value="{{ $material->name ?? old('name')}}" aria-describedby="nameHelp" >
                                        <!--<small id="senhaatualHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                                     
                                 </div>  

                                 <div class="form-group row">
                                     <label for="name" class="col-md-2 col-form-label text-md-right">Quantidade</label>
                                     <div class="col-md-10">
                                        <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" required autocomplete="new-password" maxlength="100" value="{{ $material->quantity ?? old('quantity')}}" aria-describedby="quantityHelp" step=".01">
                                        <!--<small id="senhaatualHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                                     
                                 </div>  

                                 <div class="form-group row">
                                    <label for="unit_id" class="col-md-2 col-form-label text-md-right">Unidade de Medida</label>
                                    <div class="col-md-10">
                                      <select class="form-control @error('unit_id') is-invalid @enderror" name="unit_id" aria-describedby="vendedorHelp" required>
                                        @if(!isset($material->unit_id)) <option value="" disabled selected>Selecione uma unidade de medida</option> @endif
                                        
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->id}}" {{ (isset($material->unit_id)&&($material->unit_id == $unit->id))||(old('unit_id') == $unit->id) ? 'selected':''}}>{{$unit->name}}</option>
                                        @endforeach
                                      </select> 
                                      
                                      
                                      @error('unit_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>
                                  </div>      

                                 
                                 
                                 
                                 <div class="form-group row">
                                  <label for="tel" class="col-md-2 col-form-label text-md-right">Valor (R$)</label>
                                  <div class="col-md-10">
                                    <input id="value" type="number" class="form-control @error('value') is-invalid @enderror" name="value" required autocomplete="new-password" value="{{$material->value ?? old('value')}}" aria-describedby="valueHelp" step=".01">
                                    <!--<small id="senhaatualHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                 </div>  

                                 
                                 <div class="form-group row">
                                  <label for="description" class="col-md-2 col-form-label text-md-right">Observação</label>
      
                                  <div class="col-md-10">
                                      <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" maxlength="500" aria-describedby="descriptionHelp">{{ $material->description ?? old('description')}}</textarea>
                                      <small id="descriptionHelp" class="form-text text-muted">** Opcional</small>
                                      @error('description')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                 </div>
                                 @component('components.mascaraCel') @endcomponent
                                 <div class="form-group row mb-0">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" name="cadastrar" class="btn btn-primary">
                                            Enviar
                                        </button>
                                    </div>
                                    
                                     
                                 </div>
                            </form>
                        </div>
                      </div>
                  
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <!--</div>-->

@endsection
