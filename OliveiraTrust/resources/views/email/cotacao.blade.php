<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Cotação</title>
  </head>
  <body>
    <table align="center" border="1" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th >
                    Moeda de Origem
                </th>
                <th>
                    Moeda de Destino
                </th>
                <th>
                Taxa de conversão
                </th>
                <th>
                    Forma de pagamento
                </th>
                <th>
                    Valor da moeda cotada
                </th>
                <th>
                    Taxa de forma de pagamento
                </th>
                <th>
                    Valor cotado
                </th>
                <th>
                    Valor total
                </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <a>
                            {{ $cotacao->moeda_origem }}
                        </a>
                    </td>
                    <td>
                        <a>
                            {{ $cotacao->moeda_destino }}
                        </a>
                    </td>
                    <td>
                        <a>
                            {{ $cotacao->taxa_conversao }} Reais
                        </a>
                    </td>
                    <td>
                        <a>
                            {{ $cotacao->forma_pagamento  }}
                        </a>
                    </td>
                    <td>
                        <a>
                            {{ $cotacao->valor_moeda_destino  }}
                        </a>
                    </td>
                    <td>
                        <a>
                            {{ $cotacao->taxa_forma_pagamento }} Reais
                        </a>
                    </td>
                    <td>
                        <a>
                            {{ $cotacao->valor_liquido }}
                        </a>
                    </td>
                    <td>
                        <a>
                            {{ $cotacao->valor_bruto }}
                        </a>
                    </td>
                </tr>
        </tbody>
    </table>
  </body>
</html>
