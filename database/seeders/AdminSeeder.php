<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD');
        $name     = env('ADMIN_NAME', 'Super Admin');
        $email    = env('ADMIN_EMAIL', 'admin@mystore.com');

        if (! $password) {
            $this->command->error('ADMIN_PASSWORD belum diset di .env! Seeder dibatalkan.');
            return;
        }

        Admin::firstOrCreate(
            ['username' => $username],
            [
                'name'     => $name,
                'email'    => $email,
                'password' => Hash::make($password),
            ]
        );

        $this->command->info("✓ Admin berhasil dibuat:");
        $this->command->line("  Username : {$username}");
        $this->command->line("  Email    : {$email}");
        $this->command->warn("  Password diambil dari .env — jangan share file .env ke siapapun!");
    }
}
