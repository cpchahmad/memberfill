<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
//    return view('users.default');
//})->middleware(['verify.shopify'])->name('home');

Route::group(['middleware'=>['auth.shopify','Role']], function () {
    Route::get('/', function () {
        return redirect('generals');
    })->name('dashboard');

    // products
    Route::get('/sync/products', [App\Http\Controllers\ProductController::class, 'sync_products'])->name('sync/products');
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'products_index'])->name('products');
    Route::post('/create/limit/{id}', [App\Http\Controllers\ProductController::class, 'create_limit'])->name('create/limit');


    //Groups
    Route::get('/groups', [App\Http\Controllers\GroupController::class, 'group_index'])->name('groups');
    Route::get('/create/group', [App\Http\Controllers\GroupController::class, 'create_index'])->name('create/group');
    Route::post('/create/group', [App\Http\Controllers\GroupController::class, 'store'])->name('create/group');
    Route::get('/group-delete/{id}', [App\Http\Controllers\GroupController::class, 'group_delete'])->name('group-delete');

    //Orders
    Route::get('/sync/orders', [App\Http\Controllers\OrderController::class, 'sync_orders'])->name('sync/orders');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'orders_index'])->name('orders');

    //DashBoard
    Route::get('/generals', [App\Http\Controllers\GeneralController::class, 'index'])->name('generals');
    Route::get('/product-soldout/{id}', [App\Http\Controllers\GeneralController::class, 'product_soldout'])->name('product-soldout');
    Route::get('/varient-soldout/{id}', [App\Http\Controllers\GeneralController::class, 'varient_soldout'])->name('varient-soldout');


    //Preferences
    Route::get('/preference', [App\Http\Controllers\PreferenceController::class, 'index'])->name('preference');
    Route::post('create/limit', [App\Http\Controllers\PreferenceController::class, 'create_limit'])->name('create/limit');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
