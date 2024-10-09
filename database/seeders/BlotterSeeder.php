<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blotter;

class BlotterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blotter::create([
            'complainant' => 1,
            'brgy_case_number' => 'BLTR1',
            'complaint' => 'Testimony made for testing.',
            'note' => 'note 1',
            'defendant' => "John Dela Cruz",
            'encoder' => 1,
        ]);

        Blotter::create([
            'complainant' => 1,
            'brgy_case_number' => 'BLTR2',
            'complaint' => 'Testimony made for testing.',
            'note' => 'note 2',
            'defendant' => "John Dela Cruz",
            'encoder' => 1,
        ]);

        Blotter::create([
            'complainant' => 1,
            'brgy_case_number' => 'BLTR3',
            'complaint' => 'Testimony made for testing.',
            'note' => 'note 3',
            'defendant' => "John Dela Cruz",
            'encoder' => 1,
        ]);

        Blotter::create([
            'complainant' => 2,
            'brgy_case_number' => 'BLTR4',
            'complaint' => 'Testimony made for testing.',
            'note' => 'note 4',
            'defendant' => "John Dela Cruz",
            'encoder' => 1,
        ]);

        Blotter::create([
            'complainant' => 3,           
            'brgy_case_number' => 'BLTR5',
            'complaint' => 'Testimony made for testing.',
            'note' => 'note 5',
            'defendant' => "John Dela Cruz",
            'encoder' => 1,

        ]);

        Blotter::create([
            'complainant' => 2,
            'brgy_case_number' => 'BLTR6',
            'complaint' => 'Testimony made for testing.',
            'note' => 'note 6',
            'defendant' => "John Dela Cruz",
            'encoder' => 1,
        ]);
        
    }
}
