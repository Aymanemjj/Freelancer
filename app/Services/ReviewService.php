<?php

namespace App\Services;

use App\Factories\UserFactory;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
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
        $reviews = Review::where('target_id', $id)->where('active', true)->get();

        return response()->json([
            "success" => true,
            'message' => 'Here are all the reviews for this user',
            'data' => ['reviews' => ReviewResource::collection($reviews)]
        ], 200);
    }

    public function store($id, $request)
    {
        $validated = $request->validated();
        $user = (new UserFactory())($id);
        $validated['owner_id'] = Auth::id();
        $validated['target_id'] = $user->id;

        $review = Review::create($validated);

        return response()->json([
            "success" => true,
            'message' => 'Review posted',
            'data' => ['review' => ReviewResource::make($review)]
        ], 201);
    }

    public function update($id, $request)
    {
        $validated = $request->validated();

        $review = Review::find($id);
        $review->update($validated);
        return response()->json([
            "success" => true,
            'message' => 'Review updated',
            'data' => ['review' => ReviewResource::make($review)]
        ], 200);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                "success" => false,
                'message' => 'Review not Found',
            ], 402);
        }

        $review->destroy();

        return response()->json([
            "success" => true,
            'message' => 'Review deleted',
        ], 200);
    }
}
