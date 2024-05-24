<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HistoryController;
use App\http\Controllers\PageController;
use App\Models\Doctor;
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



// admin
Route::get('/dashboard', [PageController::class, 'index'])->middleware('auth')->name('page.index');
// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
// });


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/doctors', function () {
    $doctors = Doctor::all(); // Fetch all doctors from the database
    return response()->json(['status' => 'success', 'doctors' => $doctors]);
});


Auth::routes();

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route::post('/send-otp', [OTPController::class, 'generateOTP']);
// Route::post('/verify-otp', [OTPController::class, 'verifyOTP']);
// Route::get('/register', [RegisterController::class, 'create']);
// Route::post('/register', [RegisterController::class, 'store']);

// Admin Dashboard Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// User Dashboard Route
Route::get('/userdashboard', [UserController::class, 'dashboard'])->name('userdashboard');

Route::post('login', [LoginController::class, 'login'])->name('login.post');
// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
// Route::get('/pages/index', [HomeController::class, 'index'])->name('pages.index');
Route::get('/tables', [HomeController::class, 'pass'])->name('tables');
Route::get('/typography', [HomeController::class, 'docpass'])->name('typography');
Route::get('/progress', [HomeController::class, 'progress'])->name('progress');
// Route::get('/progress', [AppointmentController::class, 'progress'])->name('user.progress');



// Route::get('/upgrade', [LoginController::class, 'logoutAutomatically'])->name('upgrade');

Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

Route::post('/typography', [DoctorController::class, 'store'])->name('pages.typography');
Route::get('/typography', [DoctorController::class, 'index'])->name('pages.typography');
Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

Route::get('/upgrade', [LoginController::class, 'logout'])->name('upgrade');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/appointment', [AppointmentController::class, 'store'])->name('user.appointment');
Route::get('/icons', [AppointmentController::class, 'index'])->name('icons');
Route::get('/appointment/{id}', [AppointmentController::class, 'getAppointment'])->name('getAppointment');
Route::post('/appointment/delete/{id}', [AppointmentController::class, 'deleteAppointment'])->name('deleteAppointment');
Route::post('/appointment/save', [AppointmentController::class, 'saveAppointment'])->name('saveAppointment');
Route::post('/appointment/{id}/reject', [AppointmentController::class, 'cancel'])->name('appointment.reject');

Route::post('/appointment/{id}/approve', [AppointmentController::class, 'approve']);
Route::post('/appointment/sendEmail', [AppointmentController::class, 'sendEmail']);




Route::get('/appointment', function () {
    return view('user.appointment');
})->name('appointment');

// Route::get('/progress', function () {
//     return view('user.progress');
// })->name('progress');

// Route::get('/userlogout', function () {
//     return redirect()->route('login');
// })->name('userlogout');


Route::group(['middleware' => 'auth'], function () {
	Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

// Route::post('/login', [LoginController::class, 'ajaxLogin'])->name('ajaxLogin');

// Route::post('/login', [LoginController::class, 'login'])->middleware('throttle_login');

Route::post('google/login', [LoginController::class, 'verify_login_email'])->name('google.authorization');

Route::post('login', [LoginController::class, 'login'])->middleware('throttle.login:5,1');

// Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');

// Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');


Route::get('/history', [HistoryController::class, 'index'])->name('historyIndex');





