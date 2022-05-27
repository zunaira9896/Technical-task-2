<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/fetch-quotes', function() {
    $quotes = [];
    for ($i=0; $i<5; $i++) {
        $response = Http::get('https://api.kanye.rest/');
        $quote = json_decode($response)->quote;
        $quotes[] = $quote;
    }
    
    return response(['quotes' => $quotes], 200);
});

