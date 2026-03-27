<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends User
{
        /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'entreprise',
        'description',
        'rating',
    ];

    protected $table= 'users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function missions(){
       return $this->hasMany(Mission::class, 'owner_id');
    }

    public function ownerReviews(){
       return $this->hasMany(Review::class, 'owner_id');
    }

    public function targetReviews(){
      return  $this->hasMany(Review::class, 'target_id');
    }

}
