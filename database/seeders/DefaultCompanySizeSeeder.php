<?php

namespace Database\Seeders;

use App\Models\CompanySize;
use Illuminate\Database\Seeder;

class DefaultCompanySizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companySizes = [
            [
                'size' => '5-10',
            ],
            [
                'size' => '11-20',
            ],
            [
                'size' => '21-50',
            ],
            [
                'size' => '51-100',
            ],
        ];
        foreach ($companySizes as $companySize) {
            CompanySize::create($companySize);
        }
    }
}
