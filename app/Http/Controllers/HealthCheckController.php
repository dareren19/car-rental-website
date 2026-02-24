<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends Controller
{
     public function __invoke(Request $request)
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['status' => 'healthy'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'unhealthy'], 503);
        }
    }
}
