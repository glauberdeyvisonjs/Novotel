<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class ProjectInit extends Command
{
    protected $signature = 'project:init';
    protected $description = 'Init project: migrate and create root user';

    public function handle(): int
    {
        $this->info('Running migrations...');
        Artisan::call('migrate', ['--force' => true]);

        $email = $this->ask('Enter root user email', 'root@example.com');
        $name = $this->ask('Enter root user name', 'Root User');
        $password = $this->secret('Enter root user password');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email format.');
            return 1;
        }
        if (empty($password)) {
            $this->error('Password cannot be empty.');
            return 1;
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'type' => 'staff',
            ]
        );

        $this->info("Root user created or updated with email: {$email}");

        return 0;
    }
}
