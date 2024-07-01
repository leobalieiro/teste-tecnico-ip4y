<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::resource('clients', ClientController::class);
Route::post('clients/send', [ClientController::class, 'send'])->name('clients.send');
Route::get('/', function () {
    return redirect()->route('clients.index');
});
