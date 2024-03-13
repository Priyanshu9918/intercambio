<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::match(['get', 'post'], '/status-info', [App\Http\Controllers\api\FrontendController::class, 'statusinfo'])->name('status-info');

Route::match(['get', 'post'], '/user-info', [App\Http\Controllers\api\FrontendController::class, 'tinfo'])->name('user-info');
Route::match(['get', 'post'], '/student-info', [App\Http\Controllers\api\FrontendController::class, 'sinfo'])->name('student-info');
Route::match(['get', 'post'], '/status-result', [App\Http\Controllers\api\FrontendController::class, 'status_url'])->name('student-result');
Route::match(['get', 'post'], '/status-result2', [App\Http\Controllers\api\FrontendController::class, 'status_url2'])->name('student-result2');