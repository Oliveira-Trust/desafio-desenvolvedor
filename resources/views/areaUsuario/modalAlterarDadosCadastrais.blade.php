<div id="alterarDadosCadastraisModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Alterar dados cadastrais</h4>
          </div>
          <form id="formAlterarDadosCadastrais" action="{{ route('alterarDadosCadastrais') }}" method="POST">
             {{ csrf_field() }}
             <input id="usuarioId" type="hidden" name="id" value="{{ Auth::user()->id }}">
             <div class="modal-body">
                <div id="msgErroModal_1" class="alert alert-danger" style="display: none">
                   <p class="mb-0"></p>
                </div>
                <div class="form-group">
                   <label class="control-label">Nome</label>
                   <input id="name" type="text" class="form-control" name="name" maxlength="255" value="{{ Auth::user()->name }}" autofocus>
                </div>
                <div class="form-group">
                   <label class="control-label">E-mail</label>
                   <input id="email" type="text" class="form-control" name="email" maxlength="255" value="{{ Auth::user()->email }}">
                </div>
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="btnAlterarDadosCadastrais" type="submit" class="btn btn-primary">Salvar</button>
             </div>
          </form>
       </div>
    </div>
 </div>