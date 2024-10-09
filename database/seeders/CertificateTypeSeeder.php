<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CertificateType;

class CertificateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CertificateType::create([ 'certificate_code' => "BRGY-CLRNC", 'certificate_type_name' => "Barangay Clearance", ]);
        CertificateType::create([ 'certificate_code' => "BRGY-INDGC", 'certificate_type_name' => "Certificate of Indigency"]);
        CertificateType::create([ 'certificate_code' => "BSNS-PRMT", 'certificate_type_name' => "Business Permit"]);
    }
}
