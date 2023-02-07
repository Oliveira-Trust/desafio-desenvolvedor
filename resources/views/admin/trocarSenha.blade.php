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
      <div class="container-fluid ">
        <div class="row">
          <!-- left column -->
          
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            
            
            <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Trocar Senha</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                  
                      <div class="col-sm-12">
                        <div class="form-group">
                            <form method="post" action="{{ route('admin.trocarSenha') }}" >
                                @csrf
                                 <div class="form-group row">
                                     <label for="senhaatual" class="col-md-4 col-form-label text-md-right">Senha Atual</label>
                                     <div class="col-md-6">
                                        <input id="senhaatual" type="password" class="form-control @error('senhaatual') is-invalid @enderror" name="senhaatual" required autocomplete="new-password" maxlength="50" aria-describedby="senhaatualHelp">
                                        <!--<small id="senhaatualHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                        @error('senhaatual')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                                     
                                 </div>  
                                 <div class="form-group row">
                                     <label for="passsword" class="col-md-4 col-form-label text-md-right">Nova Senha</label>
                                     <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" maxlength="50">
                 
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                                     
                                 </div>   
                                 <div class="form-group row" >
                                     <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmação</label>
                                     <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" maxlength="50">
                                     </div>
                                     
                                     
                                 </div>  
                                 
                                 
                 
                                 <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Alterar Senha
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
