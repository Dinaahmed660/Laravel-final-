<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
// making routes of the Dashboard
Route::get('/', function () {
    return view('welcome');
});
Route::get('index', function () {
    return view('Dashboard/index');
})->name('index') ;

Route::get('listing', function () {
    return view('Dashboard/Listing');
})->name('listing') ;

Route::get('Dashtestimonials', function () {
    return view('Dashboard/Testimonials');
})->name('Dashtestimonials') ;

Route::get('blog', function () {
    return view('Dashboard/Blog');
})->name('blog') ;

Route::get('about', function () {
    return view('Dashboard/About');
})->name('about') ;


//****************************************** */
//Routes of Car
Route::get('addcar',[CarController::class, 'create']);
Route::post('storeCar',[CarController::class, 'store'])->name('storeCar');

Route::get('editCar/{id}', [CarController::class, 'edit']);
Route::put('updateCar/{id}', [CarController::class, 'update'])->name('updateCar');

Route::get('cars', [CarController::class, 'index'])->middleware('verified');
Route::get('Single/{id}', [CarController::class, 'show'])->name('Single');


Route::get('deleteCar/{id}', [CarController::class, 'destroy']);
Route::get('trashed',[CarController::class, 'trashed']);
Route::get('restoreCar/{id}',[CarController::class, 'restore']);


//******************************* */
//Routes of Testimonials
Route::get('addtestimonial', [TestimonialController::class, 'create'])->name('addtestimonial');
Route::post('storeTestimonials',[TestimonialController::class, 'store'])->name('storeTesti');
Route::get('Testimonials', [TestimonialController::class, 'index']);

Route::get('editTestimonials/{id}', [TestimonialController::class, 'edit'])->name('editTestimonials');
Route::put('updateTestimonials/{id}', [TestimonialController::class, 'update'])->name('updateTesti');
Route::get('show/{id}', [TestimonialController::class, 'show'])->name('show');

Route::get('deleteTestimonials/{id}', [TestimonialController::class, 'destroy']);
Route::get('delete/{id}', [TestimonialController::class, 'delete']); //forcedelete
Route::get('restoreTestimonials/{id}',[TestimonialController::class, 'restore']);

/************************************** */
//Routes of Categories
Route::get('cat', [CategoryController::class, 'index'])->name('cat');
Route::get('addtcat', [CategoryController::class, 'create'])->name('addcat');
Route::post('storecat',[CategoryController::class, 'store'])->name('storeCat');

Route::get('editcat/{id}', [CategoryController::class, 'edit'])->name('editcat');
Route::put('updatecat/{id}', [CategoryController::class, 'update'])->name('updatecat');
Route::get('deletecat/{id}', [CategoryController::class, 'destroy']);

//************************************** */
Auth::routes(['verify'=>true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//*************************** */
// adding user 
Route::get('users', [UserController::class, 'index'])->middleware('verified')->name('users');
Route::get('adduser', [UserController::class, 'create'])->middleware('verified');
Route::post('storeUser', [UserController::class, 'store'])->middleware('verified')->name('storeUser');
Route::get('editUser/{id}', [UserController::class, 'edit'])->middleware('verified')->name('editUser');
Route::put('updateUser/{id}', [UserController::class, 'update'])->name('updateUser');

/************************************* */
// massaging
// Route::get('ShowMessages', function () {
//     return view('showMessage');
// });


// Route::get('contact', function () {
//     return view('Dashboard/Contact');
// })->name('Dashboard/Contact') ;

Route::get('Messages', [MessageController::class, 'index']);
Route::get('contact', [MessageController::class, 'create'])->name('Dashboard/Contact');
Route::post('store',[MessageController::class, 'store'])->name('store');
Route::get('showMessage/{id}', [MessageController::class, 'show'])->name('showMessage');
//Route::get('deleteMessage/{id}', [MessageController::class, 'delete']); 
Route::get('deleteMessage/{id}', [MessageController::class, 'destroy']);

