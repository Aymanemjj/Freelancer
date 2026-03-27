<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['title', 'description', 'budget', 'duration', 'status', 'active', 'category', 'technologies', 'owner_id'];


    public function owner(){
        return $this->belongsTo(Client::class, 'owner_id');
    }



    public function candidates(){
        return $this->hasMany(Candidate::class);
    }
}
