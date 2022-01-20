<?php

namespace Database\Seeders;

use App\Models\CareerLevel;
use Illuminate\Database\Seeder;

class CreateDefaultCareerLevelSeeder extends Seeder
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
                'level_name' => 'Entry',
            ],
            [
                'level_name' => 'Intermediate',
            ],
            [
                'level_name' => 'Senior',
            ],
            [
                'level_name' => 'Highly Skilled',
            ],
            [
                'level_name' => 'Specialist',
            ],
            [
                'level_name' => 'Developing',
            ],
            [
                'level_name' => 'Advanced',
            ],
            [
                'level_name' => 'Expert',
            ],
            [
                'level_name' => 'Principal',
            ],
            [
                'level_name' => 'Supervisor',
            ],
            [
                'level_name' => 'Sr. Supervisor',
            ],
            [
                'level_name' => 'Manager',
            ],
            [
                'level_name' => 'Sr. Manager',
            ],
            [
                'level_name' => 'Director',
            ],
            [
                'level_name' => 'Sr. Director',
            ],
            [
                'level_name' => 'Vice President',
            ],
        ];

        foreach ($input as $data) {
            CareerLevel::create($data);
        }
    }
}
