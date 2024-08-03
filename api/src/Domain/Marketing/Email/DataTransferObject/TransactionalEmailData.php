<?php

namespace Domain\Marketing\Email\DataTransferObject;
use Spatie\LaravelData\Data;

class TransactionalEmailData extends Data
{
  public function __construct(
    public readonly int $user_id,
    public readonly int $data_id,
    public readonly string $type,
  ) {
  }

  public static function rules(): array
  {
    /**
     * The type could be improved in another time
     * implementing an enum and using the enum rule
     * but at this moment there is only one type
     */
    return [
      'user_id' => ['required', 'integer', 'min:1'],
      'data_id' => ['required', 'integer', 'min:1'],
      'type' => ['required', 'string', 'in:purchase_concluded'],
    ];
  }

  public static function messages(): array
  {
    return [
      'type.*' => 'Tipo inválido!',
    ];
  }
}