@extends('layouts.template')

@section('title', 'Novo Produto')

@section('content')

    <div class="container p-5">

        <h2>Novo Produto</h2>

        <hr>

        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title" class="font-weight-bold col-form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Ex: Produto Novo">
            </div>

            <div class="form-group">
                <label for="description" class="font-weight-bold col-form-label">Descrição</label>
                <textarea name="description" id="description" class="form-control" style="height: 200px; resize: none;" placeholder="Ex: Nova descrição do produto"></textarea>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-1">
                        <label for="price" class="font-weight-bold col-form-label">Preço</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="price" id="price" class="form-control" placeholder="Ex: 199,99" required>
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
</script>
@endsection
