<?php

declare(strict_types=1);

use Migrations\AbstractSeed;
use Authentication\PasswordHasher\DefaultPasswordHasher;
/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void {
        $table = $this->table('users');
        
        $data = [
            'name' => 'Roger Maciel',
            'email' => 'rogermaciel@gmail.com',
            'password' =>  (new DefaultPasswordHasher())->hash('1q2w3e4r'),
            'status' => true,
            'created' => date('Y-m-d H:m:i'),
            'modified' => date('Y-m-d H:m:i')
        ];
        $table->insert($data)->save();
    }
}
