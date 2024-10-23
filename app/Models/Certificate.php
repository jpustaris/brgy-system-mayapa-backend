<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by_user_id', 
        'certificate_type_id', 
        'control_number', 
        'fullname', 
        'age', 
        'gender', 
        'address', 
        'living_in_brgy_since',
        'purpose',
];

    /**
     * Get the user that owns the order.
     */
    public function certificate_type()
    {
        return $this->hasOne(CertificateType::class, 'certificate_type_id');
    }

}
