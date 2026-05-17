<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Interactively create a secure super admin account';

    public function handle()
    {
        $this->info('=== MZU Secure Portal Admin Setup ===');

        $name = $this->ask('Enter the Admin\'s full name', 'System Admin');
        
        $email = $this->ask('Enter the Admin\'s email address');

        if (User::where('email', $email)->exists()) {
            $this->error('Action aborted: A user with this email already exists.');
            return Command::FAILURE;
        }

        $password = $this->secret('Enter a secure password');
        $confirmPassword = $this->secret('Confirm the password');

        if ($password !== $confirmPassword) {
            $this->error('Action aborted: Passwords do not match.');
            return Command::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("Success! Admin account for {$email} has been created and is ready for use.");
        return Command::SUCCESS;
    }
}