<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'certificate_type_id',
        'created_by_user_id',
        'description',
        'certificate_issued_to',
        'note'
    ];

    /**
     * Get the products for the supplier.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
