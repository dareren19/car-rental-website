<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebugController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $sessionData = session()->all();
        
        // Try to write to session
        session(['debug_test' => time()]);
        session()->save();
        
        // Check if session exists in database
        $dbSession = null;
        try {
            $dbSession = DB::table('sessions')->where('id', $sessionId)->first();
        } catch (\Exception $e) {
            // Table might not exist
        }
        
        return response()->json([
            'app_url' => config('app.url'),
            'env_app_url' => env('APP_URL'),
            'session' => [
                'id' => $sessionId,
                'data' => $sessionData,
                'driver' => config('session.driver'),
                'domain' => config('session.domain'),
                'secure' => config('session.secure'),
                'same_site' => config('session.same_site'),
                'db_record' => $dbSession,
            ],
            'csrf' => [
                'token' => csrf_token(),
                'header' => request()->header('X-CSRF-TOKEN'),
            ],
            'cookies' => request()->cookies->all(),
            'headers' => [
                'x-forwarded-for' => request()->header('x-forwarded-for'),
                'x-forwarded-proto' => request()->header('x-forwarded-proto'),
                'host' => request()->header('host'),
            ],
            'server' => [
                'remote_addr' => $_SERVER['REMOTE_ADDR'] ?? null,
                'http_host' => $_SERVER['HTTP_HOST'] ?? null,
                'request_uri' => $_SERVER['REQUEST_URI'] ?? null,
            ],
        ]);
    }
    
    public function testLogin()
    {
        // This simulates a login attempt without CSRF
        return response()->json([
            'session_before' => session()->all(),
            'token' => csrf_token(),
            'method' => request()->method(),
        ]);
    }
}