<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrgyOfficial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'brgy_officials';


    protected $fillable = [
        'punong_barangay', 
        'brgy_councilor1',
        'brgy_councilor2',
        'brgy_councilor3',
        'brgy_councilor4',
        'brgy_councilor5',
        'brgy_councilor6',
        'brgy_councilor7', 
        'sk_councilor', 
        'brgy_secretary', 
        'brgy_treasurer', 
];

    /**
     * Get the user that owns the order.
     */


}
