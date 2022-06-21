<?php


use App\Http\Controllers\FoodCalculatorController;
use App\Http\Controllers\FoodProductionController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\WaiterController;
use App\Http\Controllers\FoodController;


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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.layouts.master');
    })->name('dashboard');
});

// Waiter
Route::get('/waiter-List', [WaiterController::class, 'waiterList'])->name('waiter-List');
Route::post('/waiter-add', [WaiterController::class, 'waiterAdd'])->name('waiter-add');
Route::get('/waiter-Edit/{id}', [WaiterController::class, 'waiterEdit'])->name('waiter-Edit');
Route::post('/waiter-Update/{id}', [WaiterController::class, 'waiterUpdate'])->name('waiter-Update');

// Table
Route::get('/table-List', [TableController::class, 'tableList'])->name('table-List');
Route::post('/table-add', [TableController::class, 'tableAdd'])->name('table-add');
Route::get('/table-Edit/{id}', [TableController::class, 'tableEdit'])->name('table-Edit');
Route::post('/table-Update/{id}', [TableController::class, 'tableUpdate'])->name('table-Update');

// Food
Route::get('/food-List', [FoodController::class, 'foodList'])->name('food-List');
Route::post('/food-add', [FoodController::class, 'foodAdd'])->name('food-add');
Route::get('/food-Edit/{id}', [FoodController::class, 'foodEdit'])->name('food-Edit');
Route::post('/food-Update/{id}', [FoodController::class, 'foodUpdate'])->name('food-Update');



// Food Production Cost
Route::get('/food-Production', [FoodProductionController::class, 'foodProduction'])->name('food-Production');
// Route::post('/food-Productionadd', [FoodController::class, 'foodProductionAdd'])->name('food-Productionadd');



// Food Calculator
Route::get('/foodcalulator-List', [FoodCalculatorController::class, 'foodcalulatorList'])->name('foodcalulator-List');
Route::post('/foodcalulator-add', [FoodCalculatorController::class, 'foodcalulatorAdd'])->name('foodcalulator-add');
Route::get('/foodcalulator-Edit/{id}', [FoodCalculatorController::class, 'foodcalulatorEdit'])->name('foodcalulator-Edit');
Route::post('/foodcalulator-Update/{id}', [FoodCalculatorController::class, 'foodcalulatorUpdate'])->name('foodcalulator-Update');

Route::get('/foodorder-List', [FoodCalculatorController::class, 'foodorderList'])->name('foodorder-List');



Route::get('/order-List/{id}', [FoodCalculatorController::class, 'orderList'])->name('order-List');


// for kitchen
Route::get('/kitchen-status/{id}', [FoodCalculatorController::class, 'kitchenStatus'])->name('kitchen-status');
Route::get('/kitchen-List', [FoodCalculatorController::class, 'kitchenList'])->name('kitchen-List');



// for price
Route::get('/price-List', [FoodCalculatorController::class, 'priceList'])->name('price-List');
