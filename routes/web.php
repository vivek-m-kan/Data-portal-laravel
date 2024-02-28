<?php

use App\Livewire\Auth\ChooseLoginRole;
use App\Livewire\Auth\Login;
use App\Livewire\Campaigns\Create;
use App\Livewire\Campaigns\Index;
use App\Livewire\Clients\Index as ClientsIndex;
use App\Livewire\Users\Index as UsersIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function(){
    redirect('login');
});

Route::get('/login', Login::class)->name('login');
Route::get('/loginAs', ChooseLoginRole::class)->name('choose-role');

Route::middleware(['auth'])->group(function(){
    Route::prefix('campaigns')->group(function(){
        Route::get('/', Index::class);
        Route::get('/create', Create::class);
    });
    Route::prefix('users')->group(function(){
        Route::get('/', UsersIndex::class);
        // Route::get('/create', Create::class);
    });
    Route::prefix('clients')->group(function(){
        Route::get('/', ClientsIndex::class);
        // Route::get('/create', Create::class);
    });
});
