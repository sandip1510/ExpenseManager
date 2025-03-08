<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route (protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Expense management
    Route::resource('expenses', ExpenseController::class); // Index, Create, Store, Edit, Update, Destroy

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/add-category', [ExpenseController::class, 'addCategory'])->name('add.category');


});



Route::get('/expenses/export', [ReportController::class, 'export'])->name('expenses.export');


require __DIR__.'/auth.php';