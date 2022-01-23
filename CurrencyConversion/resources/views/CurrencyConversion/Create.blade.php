@extends('layouts.app')
@section('content')



<header>
	<ol>
		<li class="active">A. Telefônica</li>
		<li class="active">Adicionar</li>
	</ol>



</header>


{!! Form::open(['route' => 'CurrencyConversion.store', 'class' => 'form-inline']) !!}

@include('CurrencyConversion.Form')




<a class="btn btn-warning" href="{{ route("CurrencyConversion.index") }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Voltar</a>
<button type="submit" name="myButton" value="foo" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Salvar</button>
{!! Form::close() !!}





<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script type="text/javascript">
	$(document).ready(function($){
		$('body').on('focus', '.Telefone', function() { $(".Telefone").mask("00 00000-0000"); });

		$('body').on('click', '.Add', function() {
			var div    = $(this).attr("id");
			var newline   = $("."+div+":first").clone(false);
			newline.find("input[type='text']").val("");
			newline.find("select option[value='']").attr({ selected : "selected" });
			newline.find(".ImageExcluir").html('<i class="Remove text-danger fas fa-minus-square fa-2x"></i>');


			newline.insertAfter("."+div+":last");

		});

		$('body').on('click', '.Remove', function(){
			var qtd = $(".Remove").length;
			
			if(qtd > 1) {
				$(this).parent().parent().remove();            
			}
		});

	});

</script>


@endsection
