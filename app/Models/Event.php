<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title' , 'summary' , 'date', 'image_path','time' ];
    // protected $casts = [
    //     'date' => 'datetime',

    // ];


}
