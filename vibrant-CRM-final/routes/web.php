<?php

use App\Http\Controllers\CategoryWebController;
use App\Http\Controllers\CustomizationWebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DelivererWebController;
use App\Http\Controllers\OrderWebController;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\UserWebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('auth.login');
});

Auth::routes();

//forgot password

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Protected routes for authenticated users
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //auth routes
    

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


////////////////////////////////////////////  Category ///////////////////////////////////////////////

Route::resource('categories', CategoryWebController::class);


////////////////////////////////////////////  Product ///////////////////////////////////////////////

Route::resource('products', ProductWebController::class);


////////////////////////////////////////////  User ///////////////////////////////////////////////

Route::get('/users', [UserWebController::class, 'index'])->name('users.index');
Route::get('/users/{id}/edit', [UserWebController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserWebController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserWebController::class, 'destroy'])->name('users.destroy');


////////////////////////////////////////////  Order ///////////////////////////////////////////////

Route::get('/orders', [OrderWebController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}/edit', [OrderWebController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderWebController::class, 'update'])->name('orders.update');


////////////////////////////////////////////  Deliverer ///////////////////////////////////////////////

Route::get('/deliverers', [DelivererWebController::class, 'index'])->name('deliverers.index');
Route::get('/deliverers/create', [DelivererWebController::class, 'create'])->name('deliverers.create');
Route::post('/deliverers', [DelivererWebController::class, 'store'])->name('deliverers.store');
Route::get('/deliverers/{id}/edit', [DelivererWebController::class, 'edit'])->name('deliverers.edit');
Route::put('/deliverers/{id}', [DelivererWebController::class, 'update'])->name('deliverers.update');


////////////////////////////////////////////  Customizations ///////////////////////////////////////////////


Route::get('/customizations', [CustomizationWebController::class, 'index'])->name('customizations.index');
Route::get('/customizations/{id}/edit', [CustomizationWebController::class, 'edit'])->name('customizations.edit');
Route::put('/customizations/{id}', [CustomizationWebController::class, 'update'])->name('customizations.update');

});
