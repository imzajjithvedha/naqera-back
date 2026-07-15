<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'name' => 'Naqera',
                'email' => 'naqera@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'role' => 'admin'
            ],
            [
                'name' => 'Zajjith Ahmath',
                'email' => 'zajjith@gmail.com',
                'password' => bcrypt('secret'),
                'role' => 'host',
            ],
            [
                'name' => 'Yaarah Zajjel',
                'email' => 'yaarah@yopmail.com',
                'password' => bcrypt('secret'),
                'role' => 'agent',
            ],
            [
                'name' => 'Shajitha Banu',
                'email' => 'shajitha@yopmail.com',
                'password' => bcrypt('secret'),
                'role' => 'estate-host',
            ],
            [
                'name' => 'Mohammed Nabi',
                'email' => 'nabi@yopmail.com',
                'password' => bcrypt('secret'),
                'role' => 'customer',
            ]
        ];

        foreach ($records as $record) {
            User::create($record);
        }
    }
}
