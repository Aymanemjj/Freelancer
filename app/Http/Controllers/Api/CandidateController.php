<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Services\CandidateService;
use Exception;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    protected CandidateService $CandidateService;

    public function __construct()
    {
        $this->CandidateService = new CandidateService;
    }

    public function index($id)
    {
        $this->CandidateService->index($id);
    }

    public function store($id, StoreCandidateRequest $request)
    {
        try {
            $this->CandidateService->store($id, $request);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($mission_id, $candidate_id)
    {
        try {
            return $this->CandidateService->show($mission_id, $candidate_id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update($id, UpdateCandidateRequest $request)
    {
        try {
            return $this->CandidateService->update($id, $request);
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
            return $this->CandidateService->destroy($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function accept($id)
    {
        try {
            return $this->CandidateService->accept($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function reject($id)
    {
        try {
            return $this->CandidateService->reject($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
