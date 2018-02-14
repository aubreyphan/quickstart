<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // The attributes that are mass assignable
    protected $fillable = ['name'];

    //Get the user that owns the class
    public function user() {
        return $this->belongsTo(User::class);
    }
}
