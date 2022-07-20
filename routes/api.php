<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\WaiterController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CompanpyController;

use App\Http\Controllers\FoodCalculatorController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/app-food-List/{id}', [FoodController::class, 'appFoodList']);
Route::get('/app-waiter-List/{id}', [WaiterController::class, 'appWaiterList']);
Route::get('/app-table-List/{id}', [TableController::class, 'appTableList']);
Route::get('/company-details/{id}', [CompanpyController::class, 'companyDetails']);

Route::post('/order-store',[FoodCalculatorController::class,'appOrderStore']);