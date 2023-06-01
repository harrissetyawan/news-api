<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comments;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory(3)->create();
        News::factory(3)->create();
        Comments::create([
            'user_id' => 2,
            'news_id' => 3,
            'comment' => 'Mantap Banget Nich!',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
