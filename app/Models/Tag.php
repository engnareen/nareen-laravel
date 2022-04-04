<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable =['name' , 'status' , 'slug'];


    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function Plans(): MorphToMany
    {
        return $this->morphToMany(Plan::class, 'taggable');
    }

}
