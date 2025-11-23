<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@admin.com');
        $password = env('ADMIN_PASSWORD', '12345678');

        if (! User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => $password, // model casts `password` => 'hashed'
            ]);
        }
    }
}
