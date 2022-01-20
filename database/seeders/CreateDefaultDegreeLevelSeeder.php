<?php

namespace Database\Seeders;

use App\Models\RequiredDegreeLevel;
use Illuminate\Database\Seeder;

class CreateDefaultDegreeLevelSeeder extends Seeder
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
                'name' => 'Associate of Arts (A.A.)',
            ],
            [
                'name' => 'Associate of Science (A.S.)',
            ],
            [
                'name' => 'Associate of Applied Science (AAS)',
            ],
            [
                'name' => 'Bachelor of Arts (B.A.)',
            ],
            [
                'name' => 'Bachelor of Science (B.S.)',
            ],
            [
                'name' => 'Bachelor of Fine Arts (BFA)',
            ],
            [
                'name' => 'Bachelor of Applied Science (BAS)',
            ],
            [
                'name' => 'Master of Arts (M.A.)',
            ],
            [
                'name' => 'Master of Science (M.S.)',
            ],
            [
                'name' => 'Master of Business Administration (MBA)',
            ],
            [
                'name' => 'Master of Fine Arts (MFA)',
            ],
            [
                'name' => 'Doctor of Philosophy (Ph.D.)',
            ],
            [
                'name' => 'Juris Doctor (J.D.)',
            ],
            [
                'name' => 'Doctor of Medicine (M.D.)',
            ],
            [
                'name' => 'Doctor of Dental Surgery (DDS)',
            ],
        ];

        foreach ($input as $data) {
            RequiredDegreeLevel::create($data);
        }
    }
}
