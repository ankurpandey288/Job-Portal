<?php

namespace Database\Seeders;

use App\Models\SalaryPeriod;
use Illuminate\Database\Seeder;

class CreateDefaultSalaryPeriodSeeder extends Seeder
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
                'period'      => 'Weekly Pay Period',
                'description' => 'Weekly Pay Period',
            ],
            [
                'period'      => 'Every Other Week Pay Period',
                'description' => 'Every Other Week Pay Period',
            ],
            [
                'period'      => 'Semi Monthly Pay Period',
                'description' => 'Semi Monthly Pay Period',
            ],
            [
                'period'      => 'Monthly Pay Period',
                'description' => 'Monthly Pay Period',
            ],
        ];

        foreach ($input as $data) {
            SalaryPeriod::create($data);
        }
    }
}
