<?php

namespace Database\Seeders;

use App\Models\JobShift;
use Illuminate\Database\Seeder;

class CreateDefaultJobShiftSeeder extends Seeder
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
                'shift'       => 'First Shift',
                'description' => 'First Shift',
            ], [
                'shift'       => 'Second Shift',
                'description' => 'Second Shift',
            ], [
                'shift'       => 'Third Shift',
                'description' => 'Third Shift',
            ], [
                'shift'       => 'Fixed Shift',
                'description' => 'Fixed Shift',
            ], [
                'shift'       => 'Rotating Shift',
                'description' => 'Rotating Shift',
            ], [
                'shift'       => 'Split Shift',
                'description' => 'Split Shift',
            ], [
                'shift'       => 'On-call Shift',
                'description' => 'On-call Shift',
            ], [
                'shift'       => 'Weekday or weekend Shift',
                'description' => 'Weekday or Weekend Shift',
            ],
        ];

        foreach ($input as $data) {
            JobShift::create($data);
        }
    }
}
