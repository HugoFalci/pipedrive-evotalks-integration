<?php

use App\Http\Controllers\EvoTalksController;
use App\Http\Controllers\PipeDriveController;
use App\Http\Controllers\SyncController;
use Illuminate\Support\Facades\Route;

Route::prefix('evotalks')->group(function () {
    Route::post('/create-opportunity', [EvoTalksController::class, 'createOpportunity']);
    Route::post('/update-opportunity', [EvoTalksController::class, 'updateOpportunity']);
    Route::post('/remove-opportunity', [EvoTalksController::class, 'removeOpportunity']);
    Route::post('/lose-opportunity', [EvoTalksController::class, 'loseOpportunity']);
    Route::post('/win-opportunity', [EvoTalksController::class, 'winOpportunity']);
    Route::post('/transfer-opportunity', [EvoTalksController::class, 'transferOpportunity']);
    Route::post('/change-opportunity-stage', [EvoTalksController::class, 'changeOpportunityStage']);
    Route::post('/insert-opportunity-note', [EvoTalksController::class, 'insertOpportunityNote']);
    Route::post('/getOpportunity', [EvoTalksController::class, 'getOpportunity']);
    Route::post('/get-pipe-opportunities', [EvoTalksController::class, 'getPipeOpportunities']);
});

Route::prefix('pipedrive')->group(function () {
    Route::get('/deals', [PipeDriveController::class, 'getDeals']);
    Route::get('/deal/{id}', [PipeDriveController::class, 'getDeal']);
    Route::put('/deal/{id}', [PipeDriveController::class, 'updateDeal']);
});

Route::prefix('sync')->group(function () {
    Route::post('/pipedrive/create-opportunity', [SyncController::class, 'syncCreatedOpportunityFromPipeDrive']);
    Route::post('/pipedrive/update-opportunity', [SyncController::class, 'syncUpdatedOpportunityFromPipeDrive']);
});