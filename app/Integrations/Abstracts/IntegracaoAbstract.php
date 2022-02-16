<?php
namespace App\Integrations\Abstracts;

use App\Integrations\Interfaces\IntegracaoAbstractInterface;
use \Illuminate\Http\Response;
use GuzzleHttp\Client;

/**
 * @author Jannsen <jannsen.bgo@gmail.com>
 */
abstract class IntegracaoAbstract implements IntegracaoAbstractInterface
{
    protected $method;
    protected $endpoint;
    protected $response;
    protected $body;
    protected $headers;

    public function __construct(string $url)
    {
        $this->client = new Client(['base_uri' =>$url]);
    }

    /**
     * Método responsável por realizar as requisições aos serviços desejados
     *
     * @return void
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    protected function realizaRequisicao($code = null) : void
    {
        try {
            $response = $this->client->request($this->getMethod() ?? "POST", $this->getEndpoint(), [$this->getBody(), $this->getHeaders()]);
            if (isset($response) && $response->getStatusCode() === ($code ?? Response::HTTP_OK)) {
                $this->response   = json_decode($response->getBody()->getContents());
            }
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {
            $this->response = json_decode($e->getResponse()->getBody()->getContents());
        }
        catch (\Exception $e) {
            $this->response = $e->getMessage();
        }
    }

    /**
     * Get the value of method
     */
    public function getMethod() : ? string
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */
    public function setMethod($method) : IntegracaoAbstractInterface
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of endpoint
     */
    public function getEndpoint() : ? string
    {
        return $this->endpoint;
    }

    /**
     * Set the value of endpoint
     *
     * @return  self
     */
    public function setEndpoint($endpoint) : IntegracaoAbstractInterface
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Get the value of headers
     */
    public function getHeaders() : ? array
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */
    public function setHeaders(array $headers) : IntegracaoAbstractInterface
    {
        $this->headers = $headers;

        return $this;
    }
    /**
     * Get the value of body
     */
    public function getBody() : ? array
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */
    public function setBody(array $body) : IntegracaoAbstractInterface
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Alterando o cabeçalho da requisição para o formato default
     *
     * @return self
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    protected function setHeadersDefault(): IntegracaoAbstractInterface
    {
        $this->headers = [ "headers" => [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
        ]];
        return $this;
    }

    /**
     * Get the value of response
     */
    public function getResponse()
    {
        return $this->response;
    }
}