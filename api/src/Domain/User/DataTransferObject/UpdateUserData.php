<?php

namespace Domain\User\DataTransferObject;

use Domain\User\Enums\UserType;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
	public function __construct(
        public int $id,
		public string $name,
		public string $email,
        public string $birth_date,
        public string $type,
	) {
	}

	public static function rules(): array
	{
		return [
            'id' => ['required', 'integer', 'min:1'],
			'name' => ['required', 'string', 'max:45'],
			'email' => ['required', 'string', new Email()],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'type' => ['required', new Enum(UserType::cases())],
		];
	}
}