<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Services\ReviewService;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private ReviewService $ReviwService;

    public function __construct()
    {
        $this->ReviwService = new ReviewService();
    }


    public function index($id)
    {
        try {
            return $this->ReviwService->index($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store($id, StoreReviewRequest $request)
    {
        try {
            return $this->ReviwService->store($id, $request);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show() {}

    public function update($id, UpdateReviewRequest $request)
    {
        try {
            return $this->ReviwService->update($id, $request);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            return $this->ReviwService->destroy($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
