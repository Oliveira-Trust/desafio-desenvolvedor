<?php

namespace App\Http\Resources;

use \Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;

class DefaultResource extends JsonResource
{
    private $message;

    public function __construct($resource, string $message = "", int $statusCode = null)
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
        $this->message    = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return \array_filter(['data' => $this->resource, "message" => $this->message]);
    }

    /**
     * Transform the resource into a custom HTTP response.
     *
     * @param  \Illuminate\Http\Request|null  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return (new ResourceResponse($this))->toResponse($request)->setStatusCode($this->statusCode ?? Response::HTTP_OK);
    }
}
