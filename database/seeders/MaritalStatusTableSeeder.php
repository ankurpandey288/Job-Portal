<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusTableSeeder extends Seeder
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
                'marital_status' => 'Married',
                'description'    => 'Married',
            ],
            [
                'marital_status' => 'Widowed',
                'description'    => 'Widowed',
            ],
            [
                'marital_status' => 'Separated',
                'description'    => 'Separated',
            ],
            [
                'marital_status' => 'Divorced',
                'description'    => 'Divorced',
            ],
            [
                'marital_status' => 'Single',
                'description'    => 'Single',
            ],
        ];

        foreach ($input as $data) {
            MaritalStatus::create($data);
        }
    }
}
