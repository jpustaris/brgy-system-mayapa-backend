<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'complainant',
        'defendant',
        'brgy_case_no',
        'complaint',
        'encoder',
        'note',
    ];

    public function complainant()
    {
        return $this->hasOne(Resident::class, 'id' , 'complainant');
    }


    public function encoder()
    {
        return $this->hasOne(User::class, 'id' , 'id');
    }

}
