<?php

namespace App\Http\Controllers;

use App\Services\TestService;
use Illuminate\Http\Response;

class TestController extends Controller
{
    public function test(TestService $testService): Response
    {
        return response($testService->getMessage());
    }
}
