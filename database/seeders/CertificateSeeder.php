<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateType;
use App\Models\User;
use App\Models\Certificate;


class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificate_type = CertificateType::first(); // Assuming a user exists
        $user = User::first(); // Assuming a product exists

        Certificate::create([
            'description' => 'This is a test. Do not remove',
            'note' => 'this is a test note',
            'certificate_issued_to' => 'Sample Name 1',
            'certificate_type_id' => $certificate_type->id,
            'created_by_user_id' => $user->id,
        ]);
        Certificate::create([
            'description' => 'This is a test. Do not remove',
            'note' => 'this is a test note',
            'certificate_issued_to' => 'Sample Name 2',
            'certificate_type_id' => $certificate_type->id,
            'created_by_user_id' => $user->id,
        ]);
    }
}
