<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\majorController;
use App\Http\Controllers\StudentController;
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

//dashboad
Route::get('/', function () {
    return view('dashboard');
});
// //components
Route::get('buttons', [ComponentsController::class, 'buttons']);
Route::get('grid', [ComponentsController::class, 'grid']);
Route::get('icons', [ComponentsController::class, 'icons']);


// STUDENT
Route::resource('students', StudentController::class);
Route::get('students/{id}/hide', [StudentController::class, 'hide'])->name('students.hide');

//CLASS
Route::resource('class', ClassController::class);
Route::get('class/{id}/hide', [ClassController::class, 'hide'])->name('class.hide');

// Course
Route::resource('course', CourseController::class);


Route::get('course/{id}/hide', [CourseController::class,'hide'])->name('course.hide');

Route::get('course/passed',[CourseController::class,'passed'])->name('course.passed');

//Major
Route::resource('major',majorController::class);

Route::get('major/{id}/hide', [majorController::class,'hide'])->name('major.hide');

Route::get('major/disabled',[majorController::class,'disabled'])->name('major.disabled');

Route::get('major/{id}/showmajor',[majorController::class,'showMajor'])->name('major.showmajor');

Route::get('course/{id}/hide', [CourseController::class, 'hide'])->name('course.hide');

