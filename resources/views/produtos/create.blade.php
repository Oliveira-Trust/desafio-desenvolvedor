<html>

<form method="POST" action="{{route('salvar_produto')}}">
    @csrf
Descrição: <input type="text" name="descricao"><br>
Valor: <input type="text" name="valor"><br>
Quantidade: <input type="text" name="quantidade"><br>
<button>Salvar</button>

</form>

</html>