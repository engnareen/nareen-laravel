<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey= 'user_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'description',
        'gender',
        'birthday',
        'job_title',
        'profile_photo',
        'country',
    ];

    protected $casts=[
        'birthday' => 'date',


    ];
    public function user(){

        return $this->belongsTo(User::class,'user_id', 'id');// belongsTo بتعرف العلاقة العكسية من one to one relation
    }
}
