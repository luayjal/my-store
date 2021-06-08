<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\DashboardController;

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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('Front.index');
});

Route::get('admin',[DashboardController::class ,'show']);




 Route::namespace('Admin')
    ->prefix('admin')
    ->middleware('auth')
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

    }); 
