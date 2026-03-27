<?php

namespace App\Services;

use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class CandidateService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

        public function index($id)
    {
        $candidates = Candidate::where('mission_id', $id)->get();

        return response()->json([
            'success' => true,
            'message' => 'All available candidates for this mission',
            'data' => ['candidates' => CandidateResource::collection($candidates)]
        ]);
    }

    public function store($id,$request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['mission_id'] = $id;
        $candidate = Candidate::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Candidate created',
            'data' => ['mission' => CandidateResource::make($candidate)]
        ]);
    }

    public function update($id, $request)
    {
        $validated = $request->validated();
        $candidate = Candidate::find($id);

        if ($candidate == null) {
            return response()->json([
                'success' => false,
                'message' => "Can't find this candidate"
            ], 404);
        }

        if ($candidate->user_id != Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => "No right to edit this candidate"
            ], 403);
        }

        $candidate->update($validated);
        $candidate->save();

        return response()->json([
            'success' => true,
            'message' => 'Candidate updated',
            'data' => ['candidate' => CandidateResource::make($candidate)]
        ]);
    }

    public function show($mission_id, $candidate_id)
    {
        $candidate = Candidate::find($candidate_id);

        if ($candidate == null || $candidate->mission_id != $mission_id) {
            return response()->json([
                'success' => false,
                'message' => "Can't find this candidate"
            ], 404);
        }


        return response()->json([
            'success' => true,
            'message' => 'Candidate details',
            'data' => ["candidate" => CandidateResource::make($candidate)]
        ], 200);
    }

    public function destroy($id)
    {
        $candidate = Candidate::find($id);

        if ($candidate == null) {
            return response()->json([
                'success' => false,
                'message' => "Can't find this candidate"
            ], 404);
        }

        if ($candidate->owner_id != Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => "No right to delete this candidate"
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Candidate deleted',
        ], 200);
    }

}
