<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['titel', 'start_date', 'end_date', 'user_id'];

    public function owner(){
        return $this->belongsTo(Freelancer::class, 'user_id');
    }
}
