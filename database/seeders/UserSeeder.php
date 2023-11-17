<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'first_name' => 'User',
                'last_name' => 'Tester',
                'email' => 'user@gmail.com',
                'phone' => fake()->e164PhoneNumber(),
                'address' => fake()->address(),
                'email_verified_at' => now(),
                'password' => Hash::make('abracadabra'),
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => 'User',
                'last_name' => 'Tester2',
                'email' => 'user2@gmail.com',
                'phone' => fake()->e164PhoneNumber(),
                'address' => fake()->address(),
                'email_verified_at' => now(),
                'password' => Hash::make('abracadabra'),
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($data as $item) {
           $user = User::create($item);
            $user->posts()->createMany(
                Post::factory()->count(20)->make()->toArray()
            );
        }

    }
}
