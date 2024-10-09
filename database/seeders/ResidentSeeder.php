<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Resident;
use Carbon\Carbon;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resident::create([
            'salutation' => 'Mr.',
            'first_name' => 'Raffy',
            'middle_name' => '',
            'last_name' => 'Tulfo',
            'additional_name' => '',
            'nationality' => 'Filipino',
            'contact_number' => '09124523651',
            'email' => 'raffy.tulfo@gmail.com',
            'is_voter' => 1,
            'is_HW' => 0,
            'is_deceased' => 0,
            'age' => 45,
            'birthdate' => new Carbon('05-05-1980'),
            'gender' => 'Male',
            'height_ft' => 5.80,
            'weight_kg' => 100.00,
            'marital_status' => 'Married',
            'unique_identity' => 'Dark Complexion',
            'house_number' => '75',
            'building' => 'Test Building',
            'street' => 'Test St.',
            'other_location' => '',
            'note' => 'Test Data',
            'added_by' => 1,
        ]);

        Resident::create([
            'salutation' => 'Mrs.',
            'first_name' => 'Betty',
            'middle_name' => '',
            'last_name' => 'Tulfo',
            'additional_name' => '',
            'nationality' => 'Filipino',
            'contact_number' => '09425142638',
            'email' => 'betty.tulfo@gmail.com',
            'is_voter' => 1,
            'is_HW' => 1,
            'is_deceased' => 0,
            'age' => 38,
            'birthdate' => new Carbon('05-05-1996'),
            'gender' => 'Female',
            'height_ft' => 5.2,
            'weight_kg' => 75.00,
            'marital_status' => 'Married',
            'unique_identity' => 'Chubby',
            'house_number' => '75',
            'building' => 'Test Building',
            'street' => 'Test St.',
            'other_location' => '',
            'note' => 'Test Data',
            'added_by' => 1,
        ]);

        Resident::create([
            'salutation' => 'Ms.',
            'first_name' => 'Jenny',
            'middle_name' => 'Hilario',
            'last_name' => 'Magsaysay',
            'additional_name' => '',
            'nationality' => 'Filipino',
            'contact_number' => '09124523651',
            'email' => 'jenny.magsaysay@gmail.com',
            'is_voter' => 1,
            'is_HW' => 1,
            'is_deceased' => 0,
            'age' => 17,
            'birthdate' => new Carbon('05-05-2007'),
            'gender' => 'Female',
            'height_ft' => 4.80,
            'weight_kg' => 64.00,
            'marital_status' => 'Single',
            'unique_identity' => 'Curly Hair',
            'house_number' => '93',
            'building' => 'Test Building',
            'street' => 'Test St.',
            'other_location' => '',
            'note' => 'Test Data',
            'added_by' => 1,
        ]);
        
    }
}
