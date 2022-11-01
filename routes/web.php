<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

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


Route::get('/',[EventController::class, 'index']);
Route::get('/Events/create',[EventController::class, 'create'])->middleware('auth');
route::post('/Events', [EventController::class, 'store']);
route::get('/Events/{id}', [EventController::class, 'show']);
route::delete('/Events/{id}', [EventController::class, 'destroy'])->middleware('auth');
route::get('/Events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
route::put('/Events/update/{id}', [EventController::class, 'update'])->middleware('auth');

route::get('/dashboard',[EventController::class, 'dashboard'])->middleware('auth');

route::post('/Events/join/{id}',[EventController::class, 'joinEvent'])->middleware('auth');
route::delete('/Events/leave/{id}',[EventController::class, 'leaveEvent'])->middleware('auth');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->name('dashboard');
        
});
