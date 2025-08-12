<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;

Route::post('/community', [CommunityController::class, 'createCommunity'])->name('createCommunity');
Route::delete('/community/{community}', [CommunityController::class, 'deleteCommunity'])->name('deleteCommunity');
Route::put('/community/{community}', [CommunityController::class, 'updateCommunity'])->name('updateCommunity');

