<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Roles::insert([
            [
                "uuid" => Str::uuid(),
                "role" => "admin"
            ], [
                "uuid" => Str::uuid(),
                "role" => "client"
            ]
        ]);
        \App\Models\User::factory(30)->create();
        // \App\Models\User::factory(30)->create()->each(function ($user) {
        //     $user->roles()->sync([Roles::all()->random()->uuid]);
        // });
        \App\Models\Campaigns::factory(300)->create();
    }
}
