<?php

namespace Database\Seeders;

use App\Models\FunctionalArea;
use Illuminate\Database\Seeder;

class CreateDefaultFunctionalAreaSeeder extends Seeder
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
                'name' => 'Human Resource',
            ],
            [
                'name' => 'Marketing/Promotion',
            ],
            [
                'name' => 'Customer Service Support',
            ],
            [
                'name' => 'Sales',
            ],
            [
                'name' => 'Accounting and Finance',
            ],
            [
                'name' => 'Distribution',
            ],
            [
                'name' => 'Research and Development',
            ],
            [
                'name' => 'Administrative/Management',
            ],
            [
                'name' => 'Production',
            ],
            [
                'name' => 'Operations',
            ],
            [
                'name' => 'IT Support',
            ],
        ];

        foreach ($input as $data) {
            FunctionalArea::create($data);
        }
    }
}
