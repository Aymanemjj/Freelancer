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

    public function index()
    {
        $this->CandidateService->index();
    }

    public function store(StoreCandidateRequest $request)
    {
        try {
            $this->CandidateService->store($request);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            return $this->CandidateService->show($id);
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

}
