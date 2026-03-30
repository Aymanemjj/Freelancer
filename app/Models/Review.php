<?php

namespace App\Models;

use App\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['comment', 'rating', 'owner_id', 'target_id', 'active'];


    public function owner()
    {
        return (new UserFactory())($this->owner_id);
    }

    public function target()
    {
        return (new UserFactory())($this->target_id);
    }
}
