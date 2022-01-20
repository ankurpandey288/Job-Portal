<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            [
                'name'        => 'Computer Skill',
                'description' => 'Computer operating skill',
            ],
            [
                'name'        => 'Communication Skill',
                'description' => 'Communication skill',
            ],
            [
                'name'        => 'Customer service Skill',
                'description' => 'Customer service skill',
            ],
            [
                'name'        => 'Interpersonal Skill',
                'description' => 'Interpersonal skill',
            ],
            [
                'name'        => 'Leadership Skill',
                'description' => 'Leadership skill',
            ],
            [
                'name'        => 'Management Skill',
                'description' => 'Management skill',
            ],
            [
                'name'        => 'Problem-solving Skill',
                'description' => 'Problem-solving skill',
            ],
            [
                'name'        => 'Time management Skill',
                'description' => 'Time management skill',
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
