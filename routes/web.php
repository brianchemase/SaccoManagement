<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembershipController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admins'], function() {

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/loans', [DashboardController::class, 'loans'])->name('loans');
Route::get('/savings', [DashboardController::class, 'savings'])->name('savings');
Route::get('/savings-statement', [DashboardController::class, 'savingsStatement'])->name('savings.statement');
Route::get('/loan-statement', [DashboardController::class, 'loanStatement'])->name('loan.statement');
Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions');
Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');


//membership routes
Route::get('/members', [DashboardController::class, 'members'])->name('members');
Route::post('/members', [MembershipController::class, 'store'])->name('members.store');
Route::put('/members/{id}', [MembershipController::class, 'update'])->name('members.update');
Route::delete('/members/{id}', [MembershipController::class, 'destroy'])->name('members.destroy');

  }
    );