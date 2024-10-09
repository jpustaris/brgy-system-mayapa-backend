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
    protected $fillable = ['certificate_name', 
    'certificate_type_id'];

    /**
     * Get the user that owns the order.
     */
    public function certificate_type()
    {
        return $this->hasOne(CertificateType::class, 'certificate_type_id');
    }

}
