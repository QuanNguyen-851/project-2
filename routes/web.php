<?php

use App\Http\Controllers\AuthendController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\majorController;
use App\Http\Controllers\PayFeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubPayFeeController;
use App\Http\Middleware\Checkhasrand;
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
// checkloged

Route::middleware([CheckLoged::class])->group(function () {
    Route::get('/', [AuthendController::class, 'login'])->name('login');
    Route::post('/loginProcess', [AuthendController::class, 'loginProcess'])->name('loginProcess');
    Route::get('/foget', [AuthendController::class, 'foget'])->name('foget'); //trang nhập email
    Route::post('/findaccount', [AuthendController::class, 'findaccount'])->name('findaccount'); //check email
    Route::middleware([Checkhasrand::class])->group(function () {
        Route::get('/fogetpass', [SendMailController::class, 'fogetpass'])->name('fogetpass'); // gửi mail mã xác nhận
        Route::get('/checkrand', [AuthendController::class, 'checkrand'])->name('checkrand'); //trang xác nhận
        Route::post('/checkrandprocess', [AuthendController::class, 'checkrandprocess'])->name('checkrandprocess'); //check rand
        Route::get('/getpass', [AuthendController::class, 'getpass'])->name('getpass'); //trang đổi lại mk
        Route::post('/setpass', [AuthendController::class, 'setpass'])->name('setpass'); // lấy mật khẩu

    });
});

//for students 
Route::get('/student/{id}', [FeeController::class, 'Student'])->name('student');
Route::get('/detaiFeeForstudent/{id}', [FeeController::class, 'detaiFeeForstudent'])->name('detaiFeeForstudent');
Route::get('/detailSubFeeForstudent/{id}', [FeeController::class, 'detailSubFeeForstudent'])->name('detailSubFeeForstudent');
Route::get('/studentBKACAD', [StudentController::class, 'searchForStudent'])->name('searchForStudent');
Route::post('/checking', [StudentController::class, 'checksearchForStudent'])->name('checksearchForStudent');
Route::get('/checking/{id}', [StudentController::class, 'testError'])->name('testError');

// checklogin
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/logout', [AuthendController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthendController::class, 'dashboard'])->name('dashboard');
    // STUDENT

    Route::prefix('students')->name('students.')->group(function () {
        // Route::get('/{id}/hide', [StudentController::class, 'hide'])->name('hide');
        // Route::get('/{id}/unhide', [StudentController::class, 'unhide'])->name('unhide');
        Route::get('/importStudents', [StudentController::class, 'importStudents'])->name('importStudents');
        Route::post('/insertByExcel', [StudentController::class, 'insertByExcel'])->name('insertByExcel');
        Route::get('/exportStudentsform', [StudentController::class, 'exportStudentsform'])->name('exportStudentsform');
        Route::post('/exportStudents', [StudentController::class, 'exportStudents'])->name('exportStudents');
        Route::get('/exampleFileStudents', [StudentController::class, 'exampleFileStudents'])->name('exampleFileStudents');
        Route::get('/{id}/studentfee', [FeeController::class, 'studentfee'])->name('studentfee');
    });
    Route::resource('students', StudentController::class);


    //Fee 
    Route::prefix('fee')->name('fee.')->group(function () {
        Route::get('/{id}/studentfee', [FeeController::class, 'studentfee'])->name('studentfee');
        Route::get('/{id}/detailStuddentFee', [FeeController::class, 'detailStuddentFee'])->name('detailStuddentFee');
        Route::get('/{id}/detailStudentSubFee', [FeeController::class, 'detailStudentSubFee'])->name('detailStudentSubFee');
        Route::get('/listowefee{month}', [FeeController::class, 'listowefee'])->name('listowefee');
        Route::get('/{month}/exportlistowefee', [FeeController::class, 'exportlistowefee'])->name('exportlistowefee');
        Route::post('/exportalllistowefeeprocess', [FeeController::class, 'exportalllistowefeeprocess'])->name('exportalllistowefeeprocess');
        Route::get('/warningMail', [SendMailController::class, 'warningMail'])->name('warningMail');
        Route::get('/statistic{month}', [FeeController::class, 'statistic'])->name('statistic');
        Route::get('/{month}/exportstatistic', [FeeController::class, 'exportstatistic'])->name('exportstatistic');
        Route::get('/{id}/exportwordfee', [FeeController::class, 'exportwordfee'])->name('exportwordfee');
        Route::get('/{id}/exportwordsubfee', [FeeController::class, 'exportwordsubfee'])->name('exportwordsubfee');
        Route::get('/addcount', [PayFeeController::class, 'addcount'])->name('addcount');
        Route::get('/subaddcount', [SubPayFeeController::class, 'addcount'])->name('subaddcount');
    });
    Route::resource('fee', PayFeeController::class);
    Route::resource('subfee', SubPayFeeController::class);

    //CLASS

    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/{id}/hide', [ClassController::class, 'hide'])->name('hide');
        Route::get('/insertClass', [ClassController::class, 'insertClass'])->name('insertClass');
        Route::post('/insertClassprocess', [ClassController::class, 'insertClassprocess'])->name('insertClassprocess');
        Route::get('/insertClassExample', [ClassController::class, 'insertClassExample'])->name('insertClassExample');
    });
    Route::resource('class', ClassController::class);

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
