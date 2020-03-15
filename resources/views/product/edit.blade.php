@extends('layouts.template')

@section('title', 'Edição de Produto')

@section('content')

    <div class="container p-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h2>Editar Produto</h2>

        <hr>

        <form action="{{route('product.update', $product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title" class="font-weight-bold col-form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Ex: Produto Novo" value="{{$product->title}}">
            </div>

            <div class="form-group">
                <label for="description" class="font-weight-bold col-form-label">Descrição</label>
                <textarea name="description" id="description" class="form-control" style="height: 200px; resize: none;" placeholder="Ex: Nova descrição do produto">{{$product->description}}</textarea>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-1">
                        <label for="price" class="font-weight-bold col-form-label">Preço</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="price" id="price" class="form-control" placeholder="Ex: 199,99" value="{{number_format($product->price, 2, ',', '.')}}">
                    </div>
                </div>
            </div>

            <!-- COMPONENT START -->
            <div class="form-group mb-5">
                <div class="input-group input-file" name="photos">
			<span class="input-group-btn">
        		<button class="btn btn-secondary btn-choose" type="button">Selecionar</button>
    		</span>
                    <input type="text" class="form-control" placeholder='Escolha o Arquivo...' />
                    <span class="input-group-btn">
       			 <button class="btn btn-md btn-danger btn-reset" type="button">Limpar</button>
    		</span>
                </div>
            </div>
            <!-- COMPONENT END -->

            <div class="form-group mt-5">
                <button type="submit" class="btn btn-lg btn-success">Cadastrar</button>
            </div>

        </form>

        <div class="card-body">
            <div class="row">
                @foreach($product->photos  as $photo)
                    <div class="col-md-3 mb-3">
                        <img height="80" src="{{asset('/storage/products/' . $photo->image)}}" alt="[ FOTO DO ANÚNCIO ]" class="img-thumbnail">
                        <form class="form-inline" action="{{route('product.delphoto', $photo->id)}}" method="post" id="form-image-{{$photo->id}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="product" value="{{$product->id}}">
                            <button type="button" class="btn btn-md btn-block btn-danger" onclick="confirmDelete(this, event, 'form-image-{{$photo->id}}')">Excluir</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        function bs_input_file() {
            $(".input-file").before(
                function() {
                    if ( ! $(this).prev().hasClass('input-ghost') ) {
                        var element = $("<input type='file' class='input-ghost' name='photos[]' multiple style='visibility:hidden; height:0'>");
                        // element.attr("name",$(this).attr("name"));
                        element.change(function(){
                            element.next(element).find('input').val((element.val()).split('\\').pop());
                        });
                        $(this).find("button.btn-choose").click(function(){
                            element.click();
                        });
                        $(this).find("button.btn-reset").click(function(){
                            element.val(null);
                            $(this).parents(".input-file").find('input').val('');
                        });
                        $(this).find('input').css("cursor","pointer");
                        $(this).find('input').mousedown(function() {
                            $(this).parents('.input-file').prev().click();
                            return false;
                        });
                        return element;
                    }
                }
            );
        }

        $(function() {
            bs_input_file();
            $('#price').maskMoney({thousands: '.', decimal: ','});
        });

        function confirmDelete(t, e, id) {
            e.preventDefault();

            $('.modal-header, .close').addClass('bg-danger').addClass('text-light');
            $('#title-modal').html('Deseja Realmente excluir essa foto?')

            $('.modal-body').html('Apagando essa foto ela não estará mais disponivel para visualização!');

            $('#cancel').removeClass('btn-secondary').addClass('btn-default');
            $('#save').removeClass('btn-primary').addClass('btn-danger').data('id', id).html('Apagar');

            $('.modal').modal('show');
        }

        $(document).on('click', '#save', function () {
            let id = $(this).data('id');
            document.getElementById(id).submit();
            $('.modal').modal('hide');
        });
    </script>
@endsection
