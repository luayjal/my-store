<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Middleware\CheckUserType;

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

/* Route::get('/', function () {
    return view('welcome');
});
 */
Route::get('/dashboard', function () {
    return view('Admin.dashboard');
})->middleware('verified','user.type:admin,user')->name('dashboard');

require __DIR__.'/auth.php';

/******** Front Route *******/

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('product-details/{slug}',[ProductController::class,'show'])->name('product.details');
Route::get('cart',[CartController::class,'index'])->name('view.cart');
Route::post('cart',[CartController::class,'store'])->name('cart');

Route::get('checkout',[CheckoutController::class,'index']);
Route::post('checkout',[CheckoutController::class,'store'])->name('checkout');


/* Back End Route */
 Route::namespace('Admin')
    ->prefix('admin')
    ->middleware('verified','user.type:user,admin')
    ->as('admin.')
    ->group(function() {

        Route::group([
            'prefix'=>'categories',
            'as'=>'categories.',
        
        ],function(){
            Route::get('/',[CategoriesController::class,'index'])->name('index');
            Route::get('create',[CategoriesController::class,'create'])->name('create');
            Route::get('/{id}', 'CategoriesController@show')->name('show');
            Route::post('create',[CategoriesController::class,'store'])->name('store');
            Route::get('/{id}/edit',[CategoriesController::class,'edit'])->name('edit');
            Route::put('/{id}',[CategoriesController::class,'update'])->name('update');
            Route::delete('/{id}',[CategoriesController::class,'delete'])->name('delete');
        });
        Route::resource('products', 'ProductsController');
        Route::resource('tags', 'TagsController');
        Route::post('mark-read', [NotificationController::class,'markRead'])->name('mark.read');

    }); 