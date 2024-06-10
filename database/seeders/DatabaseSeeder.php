<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        for ($i = 1; $i < 3; $i++) {
            \App\Models\User::create([
                'username' => 'player' . $i,
                'password' => Hash::make("helloworld" . $i . "!"),
            ]);
        }
        for ($i = 1; $i < 3; $i++) {
            \App\Models\User::create([
                'username' => 'dev' . $i,
                'password' => Hash::make("hellobyte" . $i . "!"),
            ]);
        }
        for ($i = 1; $i < 3; $i++) {
            \App\Models\Admin::create([
                'username' => 'admin' . $i,
                'password' => Hash::make("hellouniverse" . $i . "!"),
            ]);
        }
        for ($i = 1; $i < 10; $i++) {
            \App\Models\Game::create([
                'title' => 'Demo Game ' . $i,
                'slug' => "demo-game-" . $i,
                "optional_thumbnail" => "thumnail",
                'description' => "this is demo game " . $i,
                'author_id' => $i - 1,
            ]);
        }
        for ($i = 1; $i < 100; $i++) {
            \App\Models\GameVersion::create([
                'game_id' => rand(0, 3),
                "path" => "aaa/aaa"
            ]);
        }
        for ($i = 1; $i < 100; $i++) {
            \App\Models\Score::create([
                'user_id' =>  rand(0, 4),
                "game_version_id" => rand(0, 10),
                "score" => rand(-500, 500),
            ]);
        }
    }
}
