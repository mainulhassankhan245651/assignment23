<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/incomesStore', [IncomeController::class, 'store'])->name('incomes.store');
Route::get('/netIncome', [IncomeController::class, 'netIncome'])->name('incomes.netIncome');
Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');

//Income and Expense Creation - Route
// use App\Http\Controllers\IncomeController;
// use App\Http\Controllers\ExpenseController;

Route::middleware(['auth'])->group(function () {
    // ...

    // Route for showing the form to add new income
    Route::get('/incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
    // Route for storing new income
    Route::post('/incomes', [IncomeController::class, 'store'])->name('incomes.store');

    // Route for showing the form to add new expense
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    // Route for storing new expense
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

    // ...
});

//Displaying Records - Route
Route::middleware(['auth'])->group(function () {
    // ...

    // Route for displaying income records
    Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');
    // Route for displaying expense records
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

    // ...
});

//Data Manipulation - Editing and Deleting - Routes
Route::middleware(['auth'])->group(function () {
    // ...

    // Route for showing the edit form for an income
    Route::get('/incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
    // Route for updating an income
    Route::put('/incomes/{income}', [IncomeController::class, 'update'])->name('incomes.update');
    // Route for deleting an income
    Route::delete('/incomes/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');

    // Route for showing the edit form for an expense
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    // Route for updating an expense
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    // Route for deleting an expense
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    // ...
});

//Filtering and Sorting - Route
Route::middleware(['auth'])->group(function () {
    // ...

    // Route for displaying income records with filtering and sorting
    Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');

    // ...
});
