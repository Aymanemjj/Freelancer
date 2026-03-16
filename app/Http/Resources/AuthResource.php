<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'role' => $this->role
        ];

        if ($this->role == 'freelancer') {
            $result['price'] = $this->price;
            $result['portfolio_link'] = $this->portfolio_link;
            $result['availability'] = $this->availability;
            $result['rating'] = $this->rating;
            $result['description'] = $this->description;
        } else if ($this->role == 'client') {
            $result['entreprise'] = $this->entreprise;
            $result['description'] = $this->description;
        }

        return $result;
    }
}
