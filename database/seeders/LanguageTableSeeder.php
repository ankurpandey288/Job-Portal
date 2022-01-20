<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'language' => 'English',
                'iso_code' => 'eng',
            ],
            [
                'language' => '	French',
                'iso_code' => 'fre (B)',
            ],
            [
                'language' => 'German',
                'iso_code' => 'ger (B)',
            ],
            [
                'language' => 'Gujarati',
                'iso_code' => 'guj',
            ], [
                'language' => 'Hindi',
                'iso_code' => 'hin',
            ],
            [
                'language' => 'Italian',
                'iso_code' => 'ita',
            ], [
                'language' => 'Nepali',
                'iso_code' => 'nep',
            ], [
                'language' => 'Russian',
                'iso_code' => 'rus',
            ],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
