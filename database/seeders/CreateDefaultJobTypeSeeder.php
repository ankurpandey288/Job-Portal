<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Seeder;

class CreateDefaultJobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'name'        => 'Architecture and Engineering',
                'description' => 'Architecture and Engineering',
            ],
            [
                'name'        => 'Arts, Design, Entertainment, Sports, and Media',
                'description' => 'Arts, Design, Entertainment, Sports, and Media',
            ],
            [
                'name'        => 'Building and Grounds Cleaning and Maintenance',
                'description' => 'Building and Grounds Cleaning and Maintenance',
            ],
            [
                'name'        => 'Business and Financial Operations',
                'description' => 'Business and Financial Operations',
            ],
            [
                'name'        => 'Community and Social Services',
                'description' => 'Community and Social Services',
            ],
            [
                'name'        => 'Computer and Mathematical',
                'description' => 'Computer and Mathematical',
            ],
            [
                'name'        => 'Construction and Extraction',
                'description' => 'Construction and Extraction',
            ],
            [
                'name'        => 'Education, Training, and Library',
                'description' => 'Education, Training, and Library',
            ],
        ];

        foreach ($input as $data) {
            JobType::create($data);
        }
    }
}
