<div id="alterarSenhaModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Alterar senha</h4>
          </div>
          <form id="formAlterarSenha" action=" {{ route('alterarSenha') }}" method="POST">
             {{ csrf_field() }}
             <input id="usuarioId" type="hidden" name="id" value="{{ Auth::user()->id }}">
             <input type="hidden" name="sandbox" value="{{ app('request')->input('sandbox') }}">
             <input type="hidden" name="conta" value="{{ app('request')->input('conta') }}">
             <div class="modal-body">
                <div id="msgErroModal_2" class="alert alert-danger" style="display: none">
                   <p class="mb-0"></p>
                </div>
                <div class="form-group">
                   <label class="control-label">Informa a nova senha</label>
                   <input id="senha_1" type="password" class="form-control" name="senha_1" maxlength="255" autofocus>
                </div>
                <div class="form-group">
                   <label class="control-label">Confirme a nova senha</label>
                   <input id="senha_2" type="password" class="form-control" name="senha_2" maxlength="255">
                </div>
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="btnAlterarSenha" type="submit" class="btn btn-primary">Salvar</button>
             </div>
          </form>
       </div>
    </div>
 </div>