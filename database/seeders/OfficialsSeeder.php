<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Officials;

class OfficialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Officials::create([ 
            'punong_barangay' => "VICTORIA T. SUMBILLO",
            'brgy_councilor1' => "JUAN CARLO R. BAUTISTA",
            'brgy_councilor2' => "LORENZO E. PEREZ JR.",
            'brgy_councilor3' => "MARJHUN P. DOLAR",
            'brgy_councilor4' => "HERMOGENES M. MIRANDA",
            'brgy_councilor5' => "SHAUNDY TORRES",
            'brgy_councilor6' => "APOLONIO O. DIMAYUGA",
            'brgy_councilor7' => "MANUEL P. CECILIO",
            'sk_councilor'	=> "NIKKY H. CARAAN",
            'brgy_secretary' => "CHRISTINE JOY OBMINA",
            'brgy_treasurer' => "HELEN L. IGNACIO",
        ]);
        }
}
