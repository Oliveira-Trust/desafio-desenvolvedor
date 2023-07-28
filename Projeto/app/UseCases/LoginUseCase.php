
<?php
// app/UseCases/LoginUseCase.php
namespace App\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;

class LoginUseCase
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute($email, $password)
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new \Exception('Invalid credentials');
        }

        // Usually you would return a session token here and not the user object
        return $user;
    }
}
