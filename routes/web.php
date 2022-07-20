<?php

use App\Http\Controllers\CompanpyController;
use App\Http\Controllers\FoodCalculatorController;
use App\Http\Controllers\FoodProductionController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\WaiterController;
use App\Http\Controllers\FoodController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
Route::get('/dashboard',[FoodCalculatorController::class,'trendingOrder'])->name('dashboard');
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
Route::get('/food-Production', [FoodProductionController::class, 'foodorderList'])->name('food-Production');
Route::get('/food-Production-List', [FoodProductionController::class, 'foodproductionList'])->name('food-Production-List');

Route::post('/ingredient',[FoodProductionController::class,'ingredient'])->name('ingredient');
Route::get('/production-status/{id}', [FoodProductionController::class, 'productionStatus'])->name('production-status');



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
Route::get('/kitchen-complete/{id}', [FoodCalculatorController::class, 'kitchenComplete'])->name('kitchen-complete');

Route::get('/kitchen-List', [FoodCalculatorController::class, 'kitchenList'])->name('kitchen-List');


// for price
Route::get('/price-List', [FoodCalculatorController::class, 'priceList'])->name('price-List');
Route::get('/price-status/{id}', [FoodCalculatorController::class, 'priceStatus'])->name('price-status');

//company setting
Route::get('/setting-company', [CompanpyController::class, 'setttingConpany'])->name('setting-company');
Route::post('/setting-company', [CompanpyController::class, 'setsetttingCompany'])->name('set-setting-company');
//company profile
Route::get('/company-profile', [CompanpyController::class, 'companyProfile'])->name('company-profile');
Route::get('/company-profiles/{id}', [CompanpyController::class, 'companyProfileDetails'])->name('company-profiles');




});

//company register



//company login
Route::group(['middleware' => ['ControlCompany']], function () {
    Route::get('/company-List', [CompanpyController::class, 'companyList'])->name('company-List');
    Route::post('/company-add', [CompanpyController::class, 'companyAdd'])->name('company-add');
    Route::get('/company-Edit/{id}', [CompanpyController::class, 'companyEdit'])->name('company-Edit');
    Route::post('/company-Update/{id}', [CompanpyController::class, 'companyUpdate'])->name('company-Update');
    
        
    });





// Route::get('/price-List', [FoodCalculatorController::class, 'priceListView'])->name('price-List-view');