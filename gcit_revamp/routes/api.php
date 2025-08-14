<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;


// Community API Routes
Route::get('/community', [CommunityController::class, 'getAllCommunities'])->name('getAllCommunities');
Route::get('/community/{community}', [CommunityController::class, 'getCommunity'])->name('getCommunity');
Route::post('/community', [CommunityController::class, 'createCommunity'])->name('createCommunity');
Route::delete('/community/{community}', [CommunityController::class, 'deleteCommunity'])->name('deleteCommunity');
Route::put('/community/{community}', [CommunityController::class, 'updateCommunity'])->name('updateCommunity');