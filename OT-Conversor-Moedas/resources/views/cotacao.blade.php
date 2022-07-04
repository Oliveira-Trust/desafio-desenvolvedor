<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
      <div class="row justify-content-center bg-black">
        <img class="col-sm-6 col-md-5 col-lg-4 col-lg-3 col-xl-3 col-xxl-3" src="/images/Logotipo-OT-white.png" alt="Logo ">
      </div>

      <div data-js="currencies-container" class="row justify-content-center mb-4 mt-4">
        <form class="row g-3">
          <div class="col-md-4">
            <label for="inputState" class="form-label">Escolha a Moeda</label>
            <select data-js="currency-one" class="form-select" id="currency-one">
              @foreach ($data as $currency)
                <option value="{{ $currency['bid'] }}">R$ {{ number_format($currency['bid'],  2, ',', '.'); }} | {{ $currency['name'] }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="Quant" class="form-label">Valor (R$)</label>
            <input type="text" class="form-control" id="valor" required>
          </div>

          <div class="col-4">
            <label for="inputZip" class="form-label">Forma de Pagamento</label>
            <div class="form-check">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineCheckbox1">Boleto</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineCheckbox2">Cartão de Crédito</label>
              </div>

            </div>
          </div>

          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" onclick="calcular();" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="Taxas serão aplicadas conforme as opções escolhidas">Calcular</button>
          </div>

          <label class="form-label"></label>

          <table class="table" id="tableTotal">
            <thead>
              <tr>

                <th scope="col">Valor da Moeda</th>
                <th scope="col">Valor da Cotação</th>

              </tr>
            </thead>
            <tbody>
              <tr>

                <td><p class="" id="valorMoeda">0,00</p></td>
                <td><p class="" id="Total">0,00</p></td>

              </tr>


            </tbody>
          </table>
        </form>



      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="./app.js"></script>
    <script type="text/javascript">
      function calcular(){
        var acrescimo = 0.0;
        if(document.getElementById("inlineRadio1").checked)
          {
            acrescimo = 1.45;
          }

        if(document.getElementById("inlineRadio2").checked)
          {
            acrescimo  = 7.63;
          }

        var valor      = parseFloat(document.getElementById('valor').value);
            valor      = valor + (valor*acrescimo/100);

        var moeda      = parseFloat(document.getElementById('currency-one').value);
            document.getElementById('valorMoeda').innerHTML = moeda.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

        var total      = valor * moeda;

        var totalGeral = total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
            document.getElementById('Total').innerHTML = totalGeral;

      }
    </script>
  </body>
</html>