<?php

use App\Http\Controllers\AuthendController;
use App\Http\Controllers\ClassController;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\majorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLoged;
use App\Http\Middleware\CheckLogin;
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
// login
Route::middleware([CheckLoged::class])->group(function () {
    Route::get('/', [AuthendController::class, 'login'])->name('login');
    Route::post('/loginProcess', [AuthendController::class, 'loginProcess'])->name('loginProcess');
});



Route::middleware([CheckLogin::class])->group(function () { // checklogin
    Route::get('/logout', [AuthendController::class, 'logout'])->name('logout');
    //dashboad
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // STUDENT
    Route::resource('students', StudentController::class);
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/{id}/hide', [StudentController::class, 'hide'])->name('hide');
        Route::get('/{id}/unhide', [StudentController::class, 'unhide'])->name('unhide');
    });



    //CLASS
    Route::resource('class', ClassController::class);
    // Route::get('class/{id}/hide', [ClassController::class, 'hide'])->name('class.hide');
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/{id}/hide', [ClassController::class, 'hide'])->name('hide');
    });


    // Course
    Route::resource('course', CourseController::class);
    Route::prefix('course')->name('course.')->group(function () {
        Route::get('/{id}/hide', [CourseController::class, 'hide'])->name('hide');
        Route::get('/passed', [CourseController::class, 'passed'])->name('passed');
    });


    //Major
    Route::resource('major', majorController::class);
    Route::prefix('major')->name('major.')->group(function () {
        Route::get('/{id}/hide', [majorController::class, 'hide'])->name('hide');
        Route::get('/disabled', [majorController::class, 'disabled'])->name('disabled');
        Route::get('/{id}/showmajor', [majorController::class, 'showMajor'])->name('showmajor');
    });


    //Scholarship
    Route::resource('scholarship', ScholarshipController::class);

    //payment
    Route::resource('payment', PaymentController::class);

    //employee
    Route::resource('employee', EmployeeController::class);
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/{id}/block', [EmployeeController::class, 'block'])->name('block');
        Route::get('/{id}/unblock', [EmployeeController::class, 'unblock'])->name('unblock');
        Route::get('/{id}/changepass', [EmployeeController::class, 'changepass'])->name('changepass');
        Route::post('/{id}/changepassProcess', [EmployeeController::class, 'changepassProcess'])->name('changepassProcess');
    });
});
