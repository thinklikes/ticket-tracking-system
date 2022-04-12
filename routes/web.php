<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('/tickets', TicketController::class)
        ->names([
            'index'  => 'tickets',
            'create' => 'tickets.create',
            'store'  => 'tickets.store',
            'edit'   => 'tickets.edit',
            'show'   => 'tickets.show',
            'update' => 'tickets.update',
        ]);

    Route::put('tickets/{ticket}/resolve', [TicketController::class, 'resolve'])
        ->name('tickets.resolve');
});
