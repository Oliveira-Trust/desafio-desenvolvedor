<?php
namespace Tests\Feature;

use App\Mail\CotacaoRealizada;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ConversorMoedasControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testEnviarEmailValidatesEmailAndSendsMail()
    {
        // Mock da resposta do e-mail
        Mail::fake();

        // Simular os dados da sessão
        session([
            'dados_cotacao' => [
                'moedaDestino' => 'USD',
                'quantidade' => 5000,
                'metodoPagamento' => 'boleto',
                'taxaDeConversao' => number_format(5.25, 2, ',', '.'),
                'taxaDePagamento' => number_format(5000 * 0.0145, 2, ',', '.'),
                'taxaDeConversaoAdicional' => number_format(5000 * 0.01, 2, ',', '.'),
                'quantidadeAposTaxas' => number_format(5000 - (5000 * 0.0145) - (5000 * 0.01), 2, ',', '.'),
                'quantidadeConvertida' => number_format((5000 - (5000 * 0.0145) - (5000 * 0.01)) / 5.25, 2, ',', '.'),
                'valorMoedaDestinoUsadoParaConversao' => number_format(5.25, 2, ',', '.'),
                'nomeMoedaDestino' => 'Dólar Americano',
                'valorMoedaDestinoInput' => 5.25,
                'taxaPagamentoInput' => 0.0145,
                'taxaConversaoAdicionalInput' => 0.01
            ]
        ]);

        // Realizar o pedido para enviar o e-mail
        $response = $this->post('/enviar-email', [
            'email' => 'test@example.com'
        ]);

        // Verificar se o e-mail foi enviado
        $response->assertStatus(200);
        Mail::assertSent(CotacaoRealizada::class, function ($mail) {
            return $mail->hasTo('test@example.com');
        });
    }

    public function testEnviarEmailHandlesValidationErrors()
    {
        // Simular os dados da sessão
        session([
            'dados_cotacao' => [
                'moedaDestino' => 'USD',
                'quantidade' => 5000,
                'metodoPagamento' => 'boleto',
                'taxaDeConversao' => number_format(5.25, 2, ',', '.'),
                'taxaDePagamento' => number_format(5000 * 0.0145, 2, ',', '.'),
                'taxaDeConversaoAdicional' => number_format(5000 * 0.01, 2, ',', '.'),
                'quantidadeAposTaxas' => number_format(5000 - (5000 * 0.0145) - (5000 * 0.01), 2, ',', '.'),
                'quantidadeConvertida' => number_format((5000 - (5000 * 0.0145) - (5000 * 0.01)) / 5.25, 2, ',', '.'),
                'valorMoedaDestinoUsadoParaConversao' => number_format(5.25, 2, ',', '.'),
                'nomeMoedaDestino' => 'Dólar Americano',
                'valorMoedaDestinoInput' => 5.25,
                'taxaPagamentoInput' => 0.0145,
                'taxaConversaoAdicionalInput' => 0.01
            ]
        ]);

        // Realizar o pedido com e-mail inválido
        $response = $this->post('/enviar-email', [
            'email' => 'invalid-email'
        ]);

        // Verificar se a resposta tem erro de validação
        $response->assertStatus(422);
        $response->assertJson([
            'error' => 'Email inválido.'
        ]);
    }
}
