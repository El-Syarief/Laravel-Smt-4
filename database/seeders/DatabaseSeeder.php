<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        user::create([
            'namaUsaha' => 'simanis hogwarts',
            'email' => 'simanis@gmail.com',
            'password' => bcrypt('simanis123'),
            'noTelp' => '08123456789',
            'alamat' => 'Hogwarts',
            'foto' => 'https://i.pinimg.com/564x/3c/0f/1b/3c0f1b6d2e4a7d8e5c9f8a2b6f4b5c7d.jpg',
            'qrCode' => 'https://i.pinimg.com/564x/3c/0f/1b/3c0f1b6d2e4a7d8e5c9f8a2b6f4b5c7d.jpg',
            'status' => 'aktif',
            'role' => 'user',
        ]);

        user::create([
            'namaUsaha' => 'amir',
            'email' => 'amir@gmail.com',
            'password' => bcrypt('amir123'),
            'noTelp' => '08123456789',
            'alamat' => 'babelan',
            'foto' => 'https://i.pinimg.com/564x/3c/0f/1b/3c0f1b6d2e4a7d8e5c9f8a2b6f4b5c7d.jpg',
            'qrCode' => 'https://i.pinimg.com/564x/3c/0f/1b/3c0f1b6d2e4a7d8e5c9f8a2b6f4b5c7d.jpg',
            'status' => 'aktif',
            'role' => 'admin',
        ]);
    }
}
