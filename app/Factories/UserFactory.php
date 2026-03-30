<?php

namespace App\Factories;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Freelancer;
use App\Models\User;

class UserFactory
{
    public function __invoke($id){
        $user = User::find($id);

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
                return null;
                break;
        }
        
    }
}
