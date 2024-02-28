<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\LeadsController;

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'check'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', function(Request $request){
            return $request->user();
        });
        Route::post("/logout", [LoginController::class, "logout"])->name('logout');
        Route::prefix('campaigns')->controller(CampaignController::class)->group(function () {
            Route::get("/{campaign?}", "get")->name('campaigns.get');
            Route::post("/", "add")->name('campaigns.add');
            Route::patch("/{campaign}", "update")->name('campaigns.update');
            Route::delete("/{campaign}", "delete")->name('campaigns.delete');
            Route::delete("/", "bulkDelete")->name('campaigns.bulkDelete');
        });

        Route::prefix('clients')->controller(ClientController::class)->group(function () {
            Route::get("/{client?}", "get")->name('clients.get');
            Route::post("/", "add")->name('clients.add');
            Route::patch("/{client}", "update")->name('clients.update');
            Route::delete("/{client}", "delete")->name('clients.delete');
        });

        Route::prefix('leads')->controller(LeadsController::class)->group(function () {
            Route::get("/{lead?}", "get")->name('leads.get');
            Route::post("/", "add")->name('leads.add');
            Route::patch("/{lead}", "update")->name('leads.update');
            Route::delete("/{lead}", "delete")->name('leads.delete');
        });
    });
});
