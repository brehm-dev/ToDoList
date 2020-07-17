<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate specific users with own policy';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
//        $this->info("This generator is for creating Users with specific privileges");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $emailValidation = Validator::make(['email' => $email], [
            'email' => 'email'
        ])->validate();

        $password = $this->argument('password');
        $role = $this->choice(
            'Set permissions for user',
            ['ROLE_ADMIN', 'ROLE_MASTER', 'ROLE_USER'],
            'ROLE_USER',
            null,
            false
        );

        $user = new User();
        $user->email = $email;
        $user->email_verified_at = now();
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->save();
        $this->info("User with email: {$email} has been created.");
    }
}
