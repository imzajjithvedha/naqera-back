<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'user_id' => 2,
                'category_id' => 2,
                'name' => 'Beachfront Studio at Corniche',
                'slug' => 'beachfront-studio-at-corniche',
                'address' => 'Main Street',
                'city' => 'Jeddah',
                'country' => 'Saudi Arabia',
                'price' => 750.00,
            ],
            [
                'user_id' => 2,
                'category_id' => 3,
                'name' => 'Luxury Chalet in Al Soudah',
                'slug' => 'luxury-chalet-in-al-soudah',
                'address' => 'Cross Street',
                'city' => 'Abha',
                'country' => 'Saudi Arabia',
                'price' => 620.00,
            ],
        ];

        foreach ($records as $record) {
            Property::create($record);
        }
    }
}
