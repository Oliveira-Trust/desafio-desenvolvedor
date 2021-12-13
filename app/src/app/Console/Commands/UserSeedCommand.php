<?php

namespace App\Console\Commands;


use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class UserSeedCommand extends Command
{
    protected array $rules = [
        'amount' => 'required|numeric',
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:seed {--amount=} {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $validator = Validator::make($this->option(), $this->rules);

        if ($validator->fails()) {
            $this->error($validator->messages());
            return 1;
        }

        (new \UserSeeder())->run([
            'amount' => intval($this->option('amount')),
            'data' => [
                'name' => $this->option('name'),
                'email' => $this->option('email'),
                'password' => bcrypt($this->option('password'))
            ]
        ]);
        return 0;
    }
}
