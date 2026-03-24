<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['letter', 'price', 'status', 'user_id', 'mission_id'];

    public function mission(){
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
