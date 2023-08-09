composer create-project laravel/laravel  Income_Expense
Create data base name  income_expense and edit on .env file(DB_DATABASE=income_expense).
composer require laravel/jetstream
php artisan jetstream:install livewire
npm install
npm run build
php artisan migrate
php artisan make:migration create_incomes_table
php artisan make:migration create_expenses_table

// database/migrations/xxxx_xx_xx_create_incomes_table.php
public function up()
{
    Schema::create('incomes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->decimal('amount', 10, 2);
        $table->string('description');
        $table->date('date');
        $table->timestamps();
    });
}

// database/migrations/xxxx_xx_xx_create_expenses_table.php
public function up()
{
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->decimal('amount', 10, 2);
        $table->string('description');
        $table->date('date');
        $table->timestamps();
    });
}
php artisan make:model Income
php artisan make:model Expense

// app/Models/Income.php
public function user()
{
    return $this->belongsTo(User::class);
}

// app/Models/Expense.php
public function user()
{
    return $this->belongsTo(User::class);
}

php artisan make:controller IncomeController
php artisan make:controller ExpenseController


//Income and Expense Creation - Route
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;

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
