<!-- <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
    /> -->
    <!-- Generic page styles -->
    <style>
        #navigation {
            margin: 10px 0;
        }
        @media (max-width: 767px) {
            #title,
            #description {
            display: none;
            }
        }
    </style>
<link rel="stylesheet" href="{{asset('file_upload/css/blueimp-gallery.min.css')}}" />
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{{asset('file_upload/css/jquery.fileupload.css')}}" />
<link rel="stylesheet" href="{{asset('file_upload/css/jquery.fileupload-ui.css')}}" />
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>
    <link rel="stylesheet" href="{{asset('file_upload/css/jquery.fileupload-noscript.css')}}" />
</noscript>
<noscript>
    <link rel="stylesheet" href="{{asset('file_upload/css/jquery.fileupload-ui-noscript.css')}}"/>
</noscript>

    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade show">
                <td>
                    <span class="preview"></span>
                </td>
                <td>
                    {% if (window.innerWidth > 480 || !o.options.loadImageFileTypes.test(file.type)) { %}
                        <p class="name">{%=file.name%}</p>
                    {% } %}
                    <div class=" error text-danger small" style="font-size: 80% !important;"></div>
                </td>
                <td>
                    <p class="size">Processing...</p>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </td>
                <td>
                    {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                        <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                            <i class="glyphicon glyphicon-edit"></i>
                            <span>Edit</span>
                        </button>
                    {% } %}
                    {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn btn-primary start" disabled>
                            <span class="icon text-white-50">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="text">Enviar</span>
                        </button>
                    {% } %}
                    {% if (!i) { %}
                        <button class="btn btn-warning cancel">
                            <span class="icon text-white-50">
                                <i class="fas fa-ban"></i>
                            </span>
                            <span class="text">Cancelar</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade show">
                <td>
                    <span class="preview">
                        {% if (file.tipo != 'video') { %}
                            {% if (file.thumbnailUrl) { %}
                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" width="160" height="160"></a>
                            {% } %}
                        {% } else { %}
                        <video src="{%=file.thumbnailUrl%}" controls=""></video>
                        {% } %}
                    </span>
                </td>
                <td>
                    {% if (window.innerWidth > 480 || !file.thumbnailUrl) { %}
                        <p class="name">
                            <span>{%=file.name%}</span>
                        </p>
                    {% } %}
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <a class="btn btn-danger btn-sm botao-deletar" href="#" data-titulo="Remover o vídeo." data-video-id="{%=file.id%}" data-action="{%=file.deleteUrl%}" data-msg="Deseja remover o video <b>XPTO</b> ?"  data-toggle="tooltip" data-placement="top"  title="Excluir" >
                            <span class="icon text-white-50">
                                <i class="fas fa-times-circle"></i>
                            </span>
                            <span class="text">Excluir</span>
                        </a>
                        <button id="botao-deletar-video-{%=file.id%}" class="btn btn-danger delete hidden" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}></button>
                    {% } else { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>
    <!-- <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"
    integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
    crossorigin="anonymous"
    ></script> -->
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{asset('file_upload/js/vendor/jquery.ui.widget.js')}}"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="{{asset('file_upload/js/tmpl.min.js')}}"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="{{asset('file_upload/js/load-image.all.min.js')}}"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="{{asset('file_upload/js/canvas-to-blob.min.js')}}"></script>
    <!-- blueimp Gallery script -->
    <script src="{{asset('file_upload/js/jquery.blueimp-gallery.min.js')}}"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{asset('file_upload/js/jquery.iframe-transport.js')}}"></script>
    <!-- The basic File Upload plugin -->
    <script src="{{asset('file_upload/js/jquery.fileupload.js')}}"></script>
    <!-- The File Upload processing plugin -->
    <script src="{{asset('file_upload/js/jquery.fileupload-process.js')}}"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="{{asset('file_upload/js/jquery.fileupload-image.js')}}"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="{{asset('file_upload/js/jquery.fileupload-audio.js')}}"></script>
    <!-- The File Upload video preview plugin -->
    <script src="{{asset('file_upload/js/jquery.fileupload-video.js')}}"></script>
    <!-- The File Upload validation plugin -->
    <script src="{{asset('file_upload/js/jquery.fileupload-validate.js')}}"></script>
    <!-- The File Upload user interface plugin -->
    <script src="{{asset('file_upload/js/jquery.fileupload-ui.js')}}"></script>
    <!-- The main application script -->
    <script src="{{asset('file_upload/js/demo.js')}}"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="{{asset('js/cors/jquery.xdr-transport.js')}}"></script>
    <![endif]-->
        