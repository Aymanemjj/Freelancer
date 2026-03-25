<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use App\Services\MissionService;
use Exception;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    protected MissionService $MissionService;

    public function __construct()
    {
        $this->MissionService = new MissionService;
    }

    public function index()
    {
        $this->MissionService->index();
    }

    public function store(StoreMissionRequest $request)
    {
        try {
            $this->MissionService->store($request);
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
            return $this->MissionService->show($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

        public function update($id, UpdateMissionRequest $request)
    {
        try {
            return $this->MissionService->update($id, $request);
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
            return $this->MissionService->destroy($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
