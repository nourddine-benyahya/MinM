<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory(50)->create();
        \App\Models\File::factory(20)->create();
        \App\Models\Message::factory(10)->create();
        \App\Models\Post::factory(20)->create();
        \App\Models\Comment::factory(100)->create();
        \App\Models\Like::factory(100)->create();
        \App\Models\Group::factory(3)->create();
        \App\Models\GroupUser::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
