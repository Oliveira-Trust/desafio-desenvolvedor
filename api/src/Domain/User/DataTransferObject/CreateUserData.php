<?php

namespace Domain\User\DataTransferObject;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
	public function __construct(
		public string $firstName,
        public string $lastName,
		public string $email,
		public string $password,
		public string $confirmPassword,
	) {
	}

	public static function rules(): array
	{
		return [
			'firstName' => ['required', 'string', 'max:45'],
            'lastName' => ['required', 'string', 'max:45'],
			'email' => ['required', 'string', new Email()],
			'password' => ['required', 'string'],
			'confirmPassword' => ['required', 'string'],
		];
	}
}
