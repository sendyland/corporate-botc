<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseRegistrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployedController;
use App\Http\Controllers\ModulePermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestEmailController;

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
Route::get('/send-test-email', [TestEmailController::class, 'sendTestEmail']);
Route::get('/send-test-email-employed', [TestEmailController::class, 'testEmail']);
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::post('course-registration', [CourseRegistrationController::class, 'createWithItem'])->name('course.registration');
Route::post('module-permission', [ModulePermissionController::class, 'store'])->name('module.permission');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/updatepassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('employeds', EmployedController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('course-order', CourseRegistrationController::class);
    Route::get('course-order/{id}/print', [CourseRegistrationController::class, 'print'])->name('course-order.print');
    Route::get('course-order/{id}/payment', [CourseRegistrationController::class, 'payment'])->name('course-order.payment');
    Route::put('course-order/payment/{id}', [CourseRegistrationController::class, 'update_payment'])->name('course-order.update_payment');
});
