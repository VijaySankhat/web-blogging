<?php

namespace Database\Seeders;

use App\Constants\UserRoles;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        //Admin Role
        User::factory()
            ->has(
                Post::factory()
                    ->count(20)
                    ->state(function (array $attributes) {
                        return ['slug' => Str::slug($attributes["title"], "-").get_slug_uuid()];
                    })
            )
            ->count(1)
            ->create(
                [
                    "username" => UserRoles::ROLE_ADMIN,
                    "email" => "admin@blog.com",
                    "password" => Hash::make('secret'),
                    'remember_token' => Str::random(10)
                ]
            )->each(function($user){
                Role::factory()
                    ->count(1)
                    ->create(['name' => 'admin'])
                    ->each(function ($role) use($user) {
                        UserRole::factory()
                            ->count(1)
                            ->create([
                                'user_id' => $user->id,
                                'role_id'   => $role->id
                            ]);
                    });
            });

        //Editor role
        User::factory()
            ->has(
                Post::factory()
                    ->count(20)
                    ->state(function (array $attributes) {
                        return ['slug' => Str::slug($attributes["title"], "-").get_slug_uuid()];
                    })
            )
            ->count(1)
            ->create(
                [
                    "username" => UserRoles::ROLE_EDITOR,
                    "email" => "editor@blog.com",
                    "password" => Hash::make('secret'),
                    'remember_token' => Str::random(10)
                ]
            )->each(function($user){
                Role::factory()
                    ->count(1)
                    ->create(['name' => 'editor'])
                    ->each(function ($role) use($user) {
                        UserRole::factory()
                            ->count(1)
                            ->create([
                                'user_id' => $user->id,
                                'role_id'   => $role->id
                            ]);
                    });
            });
    }
}
