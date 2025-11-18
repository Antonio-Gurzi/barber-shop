<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Fabio',
            'last_name' => 'Buccafurri',
            'email' => 'fabiobuccafurri@live.com',
            'password' => bcrypt('12345678'),
            'phone' => '3334445555',
            'role'  => 'admin',
        ]);

        $services = [
            [
                'service' => 'Taglio',
                'price' => 12,
                'duration' => 30
            ],
            [
                'service' => 'Taglio&Barba',
                'price' => 15,
                'duration' => 40
            ],
            [
                'service' => 'Taglio&Shampoo',
                'price' => 15,
                'duration' => 40
            ],
            [
                'service' => 'Taglio&Shampoo&Barba',
                'price' => 18,
                'duration' => 50
            ],

        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
