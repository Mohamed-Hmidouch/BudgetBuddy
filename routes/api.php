<?php

use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(App\Http\Controllers\Api\AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// Protected routes that require authentication
Route::middleware('auth:sanctum')->group(function() {
        // 1. Expense Groups
        Route::apiResource('groups', App\Http\Controllers\Api\Group\GroupController::class);
        
        // 2. Group Expenses
        Route::post('groups/{id}/expenses', [App\Http\Controllers\Api\Group\ExpenseController::class, 'store']);
        Route::get('groups/{id}/expenses', [App\Http\Controllers\Api\Group\ExpenseController::class, 'index']);
        Route::delete('groups/{id}/expenses/{expenseId}', [App\Http\Controllers\Api\Group\ExpenseController::class, 'destroy']);
        
        // 3. Group Balances
        Route::get('groups/{id}/balances', [App\Http\Controllers\Api\Group\BalanceController::class, 'index']);
        
        // 4. Settlement(reglage)
        Route::post('groups/{id}/settle', [App\Http\Controllers\Api\Group\SettlementController::class, 'store']);
        Route::get('groups/{id}/history', [App\Http\Controllers\Api\Group\SettlementController::class, 'history']);
        
        // Personal Budgets
        Route::apiResource('budgets', App\Http\Controllers\Api\Budget\BudgetController::class);
        
        // Alerts
        Route::get('alerts', [App\Http\Controllers\Api\Alert\AlertController::class, 'index']);
        
        // Expense Anomalies
        Route::get('expenses/anomalies', [App\Http\Controllers\Api\Expense\ExpenseController::class, 'anomalies']);
        
        // Recurring Expenses
        Route::apiResource('recurring-expenses', App\Http\Controllers\Api\Expense\RecurringExpenseController::class)->except(['update']);
        
        // Financial Reports
        Route::get('reports/summary', [App\Http\Controllers\Api\Report\ReportController::class, 'summary']);
        Route::get('reports/custom', [App\Http\Controllers\Api\Report\ReportController::class, 'custom']);


    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::resource('tag', TagController::class)->middleware(['auth:sanctum']);
