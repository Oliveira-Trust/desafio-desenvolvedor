
<?php
// app/Domain/Entities/User.php
namespace App\Domain\Entities;

class User
{
    private $id;
    private $email;
    private $password;
    
    public function __construct($id, $email, $password) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }
    
    // getters and setters
}
