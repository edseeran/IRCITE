<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::group([
    'prefix' => 'auth'

], function ($route) {

$route->post('/register', [AuthController::class,'register']);
$route->post('/login',    [AuthController::class,'login']);
   
    Route::group([
    'middleware' => 'auth:sanctum',

], function ($route) {
    $route->post('/logout', [AuthController::class,'logout']);
});
});


Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});