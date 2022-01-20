<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CreateDefaultPostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $input = [
            [
                'name'        => 'Job Experience',
                'description' => $faker->realText(200),
            ],
            [
                'name'        => 'New Technology',
                'description' => $faker->realText(200),
            ],
            [
                'name'        => 'Job Related',
                'description' => $faker->realText(200),
            ],
            [
                'name'        => 'Company Culture',
                'description' => $faker->realText(200),
            ],
            [
                'name'        => 'Job Applicants',
                'description' => $faker->realText(200),
            ],
            [
                'name'        => 'Job Vacancy',
                'description' => $faker->realText(200),
            ],
        ];

        foreach ($input as $data) {
            PostCategory::create($data);
        }
    }
}
