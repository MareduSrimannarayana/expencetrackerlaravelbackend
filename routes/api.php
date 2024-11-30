<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController; // <-- Fix: add the semicolon

/*
|--------------------------------------------------------------------------|
| API Routes                                                                |
|--------------------------------------------------------------------------|
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Example route (auth: Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get all items (Read)
Route::get('/items', [ItemController::class, 'index']);  

// Get a specific item by ID (Read)
Route::get('/items/{id}', [ItemController::class, 'show']);  

// Create a new item (Create)
Route::post('/items', [ItemController::class, 'store']);  

// Update an existing item (Update)
Route::put('/items/{id}', [ItemController::class, 'update']);  

// Delete an item (Delete)
Route::delete('/items/{id}', [ItemController::class, 'destroy']);
