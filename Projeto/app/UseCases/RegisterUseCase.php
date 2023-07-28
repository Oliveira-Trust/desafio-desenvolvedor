
<?php
// app/UseCases/RegisterUseCase.php
namespace App\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;

class RegisterUseCase
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute($email, $password)
    {
        $user = $this->userRepository->getUserByEmail($email);

        if ($user) {
            throw new \Exception('User already exists');
        }

        $user = new User(null, $email, password_hash($password, PASSWORD_BCRYPT));

        return $this->userRepository->saveUser($user);
    }
}
