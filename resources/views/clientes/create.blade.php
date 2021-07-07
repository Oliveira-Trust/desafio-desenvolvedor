<html>

<form method="POST" action="{{route('salvar_cliente')}}">
  @csrf  
Nome: <input type="text" name="nome"><br>
<button>Salvar</button>

</form>

</html>