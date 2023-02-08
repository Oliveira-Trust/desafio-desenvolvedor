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
      <div class="container-fluid">
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
                                 
                                 
                                 <div class="form-group row">
                                    <label for="currency_code" class="col-md-2 col-form-label text-md-right">Moeda Destino</label>
                                    <div class="col-md-10">
                                      <select class="form-control @error('currency_code') is-invalid @enderror" name="currency_code" aria-describedby="currency_codeHelp" required>
                                        <option value="" disabled selected>Selecione a moeda que deseja comprar</option> 
                                        
                                        @foreach ($currencyTypes as $currency)
                                            <option value="{{$currency->code}}" {{ (old('currency_code') == $currency->id) ? 'selected':''}}>{{$currency->name}}</option>
                                        @endforeach
                                      </select> 
                                      
                                      
                                      @error('currency_code')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>
                                  </div>      

                                 
                                 
                                 
                                 <div class="form-group row">
                                  <label for="tel" class="col-md-2 col-form-label text-md-right">Valor (R$)</label>
                                  <div class="col-md-10">
                                    <input id="value" type="number" class="form-control @error('value') is-invalid @enderror" name="value" required autocomplete="new-password" value="{{old('value')}}" aria-describedby="valueHelp" min="1000" max="99999" step="0.01">
                                    <!--<small id="senhaatualHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                 </div>  

                                 <div class="form-group row">
                                  <label for="payment_id" class="col-md-2 col-form-label text-md-right">Forma de Pagamento</label>
                                  <div class="col-md-10">
                                    <select class="form-control @error('payment_id') is-invalid @enderror" name="payment_id" aria-describedby="payment_idHelp" required>
                                      <option value="" disabled selected>Selecione a forma de pagamento</option> 
                                      
                                      @foreach ($paymentsMethods as $payment)
                                          <option value="{{$payment->id}}" {{ (old('payment_id') == $payment->id) ? 'selected':''}}>{{$payment->name}}</option>
                                      @endforeach
                                    </select> 
                                    
                                    
                                    @error('payment_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>      


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
