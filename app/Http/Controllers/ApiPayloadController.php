<?php

namespace App\Http\Controllers;

use App\Service\ApiPayloadService;
use Illuminate\Http\Request;

class ApiPayloadController extends Controller
{
    public function index(ApiPayloadService $apiPayloadService)
    {
        return $apiPayloadService->list();
    }
}
