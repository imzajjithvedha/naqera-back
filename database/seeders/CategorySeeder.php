<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'name' => 'Apartment',
                'slug' => 'apartment',
            ],
            [
                'name' => 'Villa',
                'slug' => 'villa'
            ],
            [
                'name' => 'Hotel Apartment',
                'slug' => 'hotel-apartment'
            ],
            [
                'name' => 'Chalet',
                'slug' => 'chalet'
            ],
            [
                'name' => 'Resort',
                'slug' => 'resort'
            ],
            [
                'name' => 'Studio',
                'slug' => 'studio'
            ],
        ];

        foreach ($records as $record) {
            Category::create($record);
        }
    }
}
