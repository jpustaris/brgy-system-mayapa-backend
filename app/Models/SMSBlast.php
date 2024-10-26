<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMSBlast extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'sms_blasts';


    protected $fillable = [
        'member_ids',
        'member_numbers',
        'message_content',
        'created_by_user_id',
    ];

    public function creator()
    {
        return $this->hasOne(User::class, 'id' , 'created_by_user_id');
    }


    public function member_details()
    {
        return $this->hasOne(User::class, 'id' , 'member_ids');
    }

}
