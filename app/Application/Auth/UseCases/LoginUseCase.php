<?php
namespace Application\Auth\UseCases;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Presentation\Api\V1\Resources\Auth\AuthLoginResource;
use Shared\Enums\HttpStatus;
use Shared\Exceptions\HttpException;
use Shared\Interfaces\UseCase;

final class LoginUseCase implements UseCase {
    public function execute($data) {
        $user = User::where('email', $data->email)->first();

        if (!$user || !Hash::check($data->password, $user->password)) {
            throw new HttpException(
                'Invalid e-mail or password',
                HttpStatus::Unauthorized
            );
        }

        $token = $user->createToken('unknown');

        return new AuthLoginResource($token);
    }
}
