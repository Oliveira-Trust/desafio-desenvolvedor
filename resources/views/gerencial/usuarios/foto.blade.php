<style>
    .label {
      cursor: pointer;
    }
    .img-container img {
      max-width: 100%;
    }
  </style>
  <link rel="stylesheet" href="{{asset('sb-admin-2-assets/cropper/css/cropper.css')}}">
  <script src="{{asset('sb-admin-2-assets/cropper/js/cropper.js')}}"></script>
  <script src="{{asset('js/usuarios/meus_dados.js')}}"></script>
    <div class="form-row">
      <div class="form-group col-md-12">
        <div class="img-container">
          <!-- <img class="rounded" id="avatar-foto-usuario" src="{{ (file_exists(public_path('/upload/'.Auth::user()->empresa_id.'/avatar/'.Auth::user()->id.'/'.Auth::user()->foto)) ? public_path('/upload/'.Auth::user()->empresa_id.'/avatar/'.Auth::user()->id.'/'.Auth::user()->foto)  : asset('img/usuario/user-icon.png')  )}}" alt="avatar"> -->
          <img class="rounded img-thumbnail" id="avatar-foto-usuario" src="{{ (!empty(Auth::user()->foto) ? asset(Auth::user()->foto) : asset('img/usuario/user-icon.png'))}}" alt="avatar">
        </div>
      </div>
      <div class="form-group col-md-12 pl-2 ">
        <label class="btn btn-primary btn-upload pt-2" data-toggle="tooltip" title="Trocar a foto">
          <input type="file" class="sr-only" id="arquivo-foto-usuario" name="imagem" accept="image/*">
          <span class="docs-tooltip" >
            <i class="fa fa-upload"></i> Alterar foto
          </span>
        </label>
      </div>
    </div>  
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
  <div class="modal fade" id="modal-cortar-foto" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Crop the image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <img id="imagem-modal" src="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="crop">Crop</button>
        </div>
      </div>
    </div>
  </div>
  