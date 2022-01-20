<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
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
                'name'        => 'Agricultural Inspectors',
                'description' => 'Inspect agricultural commodities, processing equipment, and facilities, and fish and logging operations, to ensure compliance with regulations and laws governing health, quality, and safety.',
                'is_featured' => 1,
            ],
            [
                'name'        => 'Civil Engineers',
                'description' => 'Perform engineering duties in planning, designing, and overseeing construction and maintenance of building structures, and facilities, such as roads, railroads, airports, bridges, harbors, channels, dams, irrigation.',
                'is_featured' => 0,
            ],
            [
                'name'        => 'Broadcast Technicians',
                'description' => 'Set up, operate, and maintain the electronic equipment used to transmit radio and television programs. Control audio equipment to regulate volume level and quality of sound during radio and television broadcasts',
                'is_featured' => 1,
            ],
            [
                'name'        => 'Accountants',
                'description' => 'Analyze financial information and prepare financial reports to determine or maintain record of assets, liabilities, profit and loss, tax liability, or other financial activities within an organization.',
                'is_featured' => 0,
            ],
            [
                'name'        => 'Coaches and Scouts',
                'description' => 'Instruct or coach groups or individuals in the fundamentals of sports. Demonstrate techniques and methods of participation. May evaluate athletes\' strengths and weaknesses as possible recruits or to improve the same.',
                'is_featured' => 1,
            ],
            [
                'name'        => 'Actuaries',
                'description' => 'Analyze statistical data, such as mortality, accident, sickness, disability, and retirement rates and construct probability tables to forecast risk and liability for payment of future benefits.',
                'is_featured' => 0,
            ],
            [
                'name'        => 'Climate Change Analysts',
                'description' => 'Research and analyze policy developments related to climate change. Make climate-related recommendations for actions such as legislation, awareness campaigns, or fundraising approaches.',
                'is_featured' => 1,
            ],
            [
                'name'        => 'Biomedical Engineers',
                'description' => 'Apply knowledge of engineering, biology, and biomechanical principles to the design, development, and evaluation of biological and health systems and products, such as artificial organs, prostheses, instrumentation, etc',
                'is_featured' => 1,
            ],
        ];

        foreach ($input as $data) {
            JobCategory::create($data);
        }
    }
}
