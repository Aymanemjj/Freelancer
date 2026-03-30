<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private ReviewService $ReviwService;

    public function __construct()
    {
        $this->ReviwService = new ReviewService();
    }


    public function index($id){
        
    }
}
