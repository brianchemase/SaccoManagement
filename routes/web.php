<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\LoanController;


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



//Route::get('/savings-statement', [DashboardController::class, 'savingsStatement'])->name('savings.statement');
Route::get('/loan-statement', [DashboardController::class, 'loanStatement'])->name('loan.statement');
Route::get('/transactions', [DashboardController::class, 'transactions'])->name('transactions');
Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');


//membership routes
Route::get('/members', [DashboardController::class, 'members'])->name('members');
Route::post('/members', [MembershipController::class, 'store'])->name('members.store');
Route::put('/members/{id}', [MembershipController::class, 'update'])->name('members.update');
Route::delete('/members/{id}', [MembershipController::class, 'destroy'])->name('members.destroy');

//savings route
Route::get('/savings', [DashboardController::class, 'savings'])->name('savings');
//Route::get('/savings', [SavingsController::class, 'index'])->name('savings.index');
Route::post('/savings/store', [SavingsController::class, 'store'])->name('savings.store');
//member statements
Route::get('savings/statement', [SavingsController::class, 'statement'])->name('savings.statement');


//savings statement
Route::GET('/client/statement/{memberno}', [SavingsController::class, 'tablestatement'])->name('singlememberstatement');



//loan management routes
Route::get('/loans', [DashboardController::class, 'loans'])->name('loans');
//Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');           // List all loans
Route::get('/loans/RegisterLoan', [LoanController::class, 'create'])->name('loans.create');  // Loan application form
Route::post('/loans/store', [LoanController::class, 'store'])->name('loans.store');    // Store new loan
Route::get('/loans/{id}', [LoanController::class, 'show'])->name('loans.show');        // View single loan
Route::get('/loans/{id}/edit', [LoanController::class, 'edit'])->name('loans.edit');   // Edit form
Route::post('/loans/{id}/update', [LoanController::class, 'update'])->name('loans.update'); // Update loan
Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');    // Delete loan


// Loan Repayment Routes
Route::get('/repayments/create', [LoanController::class, 'LoanRepayment'])->name('repayments.create');
Route::post('/repayments/store', [LoanController::class, 'RegisterRepayment'])->name('repayments.store');


  }
    );