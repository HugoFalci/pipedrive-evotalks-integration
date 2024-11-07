<?php

use App\Http\Controllers\EvoTalksController;
use Illuminate\Support\Facades\Route;

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
