<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use  HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'salutation',
        'first_name',
        'middle_name',
        'last_name',
        'additional_name',
        'nationality',
        'contact_number',
        'email',
        'is_voter',
        'birth_date',
        'is_HW',
        'is_PWD',
        'disability',
        'is_deceased',
        'age',
        'birthdate',
        'gender',
        'height_ft',
        'weight_kg',
        'marital_status',
        'unique_identity',
        'house_number',
        'building',
        'street',
        'other_location',
        'note',
    ];


    
}