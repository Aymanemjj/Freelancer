<?php

namespace App\Factories;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Freelancer;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserFactory
{
    public function __invoke($id){
        $user = User::findOrFail($id);

        switch($user->role){
            case "admin":
                return Admin::find($id);
                break;
            case "client":
                return Client::find($id);
                break;
            case "freelancer":
                return Freelancer::find($id);
                break;
            default:
                throw new ModelNotFoundException();
                break;
        }
        
    }
}
