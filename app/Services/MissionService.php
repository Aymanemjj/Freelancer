<?php

namespace App\Services;

use App\Http\Resources\MissionResource;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;

class MissionService
{

    /**
     * Create a new class instance.
     */
    public function __construct() {}


    public function index()
    {
        $missions = Mission::where('active', true)->where('status', 'pending')->get();

        return response()->json([
            'success' => true,
            'message' => 'All available missions',
            'data' => ['missions' => MissionResource::collection($missions)]
        ]);
    }

    public function store($request)
    {
        $validated = $request->validated();
        $validated['owner_id'] = Auth::id();
        $mission = Mission::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Mission created',
            'data' => ['mission' => MissionResource::make($mission)]
        ]);
    }

    public function update($id, $request)
    {
        $validated = $request->validated();
        $mission = Mission::find($id);

        if ($mission == null) {
            return response()->json([
                'success' => false,
                'message' => "Can't find this mission"
            ], 404);
        }

        if ($mission->owner_id != Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => "No right to edit this mission"
            ], 403);
        }

        $mission->update($validated);
        $mission->save();

        return response()->json([
            'success' => true,
            'message' => 'Mission updated',
            'data' => ['mission' => MissionResource::make($mission)]
        ]);
    }

    public function show($id)
    {
        $mission = Mission::find($id);

        if ($mission == null) {
            return response()->json([
                'success' => false,
                'message' => "Can't find this mission"
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Mission details',
            'data' => ["mission" => MissionResource::make($mission)]
        ], 200);
    }

    public function destroy($id)
    {
        $mission = Mission::find($id);

        if ($mission == null) {
            return response()->json([
                'success' => false,
                'message' => "Can't find this mission"
            ], 404);
        }

        if ($mission->owner_id != Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => "No right to delete this mission"
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Mission deleted',
        ], 200);
    }
}
