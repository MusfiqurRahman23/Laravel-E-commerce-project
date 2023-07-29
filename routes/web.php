<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
route::get('/',[HomeController ::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
route::get('/redirect',[HomeController ::class,'redirect'])->middleware('auth','verified');
route::get('/view_catagory',[AdminController ::class,'view_catagory']);
route::post('/add_catagory',[AdminController ::class,'add_catagory']);
route::get('/delete_category/{id}',[AdminController ::class,'delete_category']);
route::get('/view_product',[AdminController ::class,'view_product']);
route::post('/add_product',[AdminController ::class,'add_product']);
route::get('/show_product',[AdminController ::class,'show_product']);
route::get('/delete_product/{id}',[AdminController ::class,'delete_product']);
route::get('/edit_product/{id}',[AdminController ::class,'edit_product']);
route::post('/update_product_confirm/{id}',[AdminController ::class,'update_product_confirm']);
route::get('/order',[AdminController ::class,'order']);
route::get('/delivered/{id}',[AdminController ::class,'delivered']);
route::get('/print_pdf/{id}',[AdminController ::class,'print_pdf']);
route::get('/search',[AdminController ::class,'searchData']);


route::get('/product_details/{id}',[HomeController ::class,'product_details']);
route::post('/add_cart/{id}',[HomeController ::class,'add_cart']);
route::get('/show_cart',[HomeController ::class,'show_cart']);
route::get('/remove_cart/{id}',[HomeController ::class,'remove_cart']);
route::get('/Cash_Order',[HomeController ::class,'Cash_Order']);
route::get('/stripe/{$total_price}',[HomeController ::class,'stripe']);
Route::post('/stripe',[HomeController ::class, 'stripePost'])->name('stripe.post');
route::get('/products',[HomeController ::class,'products']);
route::get('/product_search',[HomeController ::class,'product_search']);
route::get('/show_order',[HomeController ::class,'show_order']);
route::get('/cancel_order/{id}',[HomeController ::class,'cancel_order']);
route::get('/search_product',[HomeController ::class,'search_product']);
route::get('/about',[HomeController ::class,'about']);
route::get('/Contact',[HomeController ::class,'Contact']);
