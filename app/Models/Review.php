<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['comment', 'rating', 'owner_id', 'target_id', 'active'];


    public function owner()
    {
        return  $this->belongsTo(User::class, 'owner_id');
    }

    public function target()
    {
        return  $this->hasMany(User::class, 'target_id');
    }
}
