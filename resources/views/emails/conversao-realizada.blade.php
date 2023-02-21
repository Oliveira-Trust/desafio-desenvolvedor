<x-mail::message>
# Olá {{auth()->user()->name}}!

### Uma nova conversão foi realizada com sucesso ;)

<x-mail::panel>
## Valor convertido:
# {{round($conversao['valorConvertido'], 2)}} - {{$conversao['destino']}}
</x-mail::panel>

<x-mail::table>
| Cotação       | Tx Conversão  | Forma Pagamento  | Taxa Pgto       | Valor da Compra
| ------------- |:-------------:| :--------------: | :--------------:|:--------------:
| R${{number_format($conversao['valorCotacao'],2,",",".")}} | R${{number_format($conversao['taxaConversao'],2,",",".")}} | {{$conversao['nomeFormaPagamento']}} | R${{number_format($conversao['taxaPagamento'],2,",",".")}}        | R${{number_format($conversao['valorCompra'],2,",",".")}}
</x-mail::table>

Agradecemos a preferência 💞<br>
</x-mail::message>
