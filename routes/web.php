<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardManagementController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix' => 'card', 'as'=>'card.'], function () {
    
    Route::get('/', [CardManagementController::class, 'idCardListIndex'])->name('index');
    Route::get('/create/{id?}', [CardManagementController::class, 'idCardCreate'])->name('create'); 
    Route::post('/save', [CardManagementController::class, 'idCardStore'])->name('store'); 
    Route::get('/delete/{id}', [CardManagementController::class, 'idCardListDelete'])->name('delete'); 
 
});


