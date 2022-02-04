<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   <title>Lista das ultimas 10 cotação</title>
</head>

<body>
   <table class="table">
      <thead>
         <tr>
            <th scope="col">Moeda de origem</th>
            <th scope="col">Moeda de destino</th>
            <th scope="col">Valor para conversão</th>
            <th scope="col">Forma de pagamento</th>
            <th scope="col">Valor da "Moeda de destino" usado para conversão</th>
            <th scope="col">Valor comprado em "Moeda de destino</th>
            <th scope="col">Taxa de pagamento</th>
            <th scope="col">Taxa de conversão</th>
            <th scope="col">Valor utilizado para conversão descontando as taxas</th>
         </tr>
      </thead>
      <tbody>
         @foreach($hexchange as $data)
         <tr>
            <td>{{ $data->cur_origim }}</td>
            <td>{{ $data->cur_destiny }}</td>
            <td>{{ $data->val_input }}</td>
            <td>{{ $data->mhd_payment }}</td>
            <td>{{ $data->val_cur_destiny }}</td>
            <td>{{ $data->val_buy }}</td>
            <td>{{ $data->rate_payment }}</td>
            <td>{{ $data->rate_conversion }}</td>
            <td>{{ $data->discont_onversion }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
   <!-- Optional JavaScript; choose one of the two! -->

   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   <!-- Option 2: Separate Popper and Bootstrap JS -->
   <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>