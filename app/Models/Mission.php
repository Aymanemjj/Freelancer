<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['title', 'description', 'budget', 'duration', 'status', 'active', 'category_id', 'owner_id'];


    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function candidates(){
        return $this->hasMany(Candidate::class);
    }
}
