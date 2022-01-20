<?php

namespace Database\Seeders;

use App\Models\OwnerShipType;
use Illuminate\Database\Seeder;

class CreateDefaultOwnerShipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ownerTypes = [
            [
                'name'        => 'Sole Proprietorship',
                'description' => 'The sole proprietorship is the simplest business form under which one can operate a business.',
            ],
            [
                'name'        => 'Public',
                'description' => 'A company whose shares are traded freely on a stock exchange.',
            ],
            [
                'name'        => 'Private',
                'description' => 'A company whose shares may not be offered to the public for sale and which operates under legal requirements less strict than those for a public company.',
            ],
            [
                'name'        => 'Government',
                'description' => 'A government company is a company in which 51% or more of the paid-up capital is held by the Government or State Government.',
            ],
            [
                'name'        => 'NGO',
                'description' => 'A non-profit organization that operates independently of any government, typically one whose purpose is to address a social or political issue.',
            ],
        ];

        foreach ($ownerTypes as $ownerType) {
            OwnerShipType::create($ownerType);
        }
    }
}
