<?php

namespace App\Services;

use App\Models\Mission;

class MissionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }




    public function create($request){
        $validated = $request->validated();
        
        Mission::create($validated);

        
    }
}
