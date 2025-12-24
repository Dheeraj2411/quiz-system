<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;

// Route::get('/', function () {
//     return view('welcome');
// });


//user route without login
Route::get('/', [UserController::class, 'welcome']);
Route::get('user-quiz-list/{id}/{category}', [UserController::class, 'userQuizList']);
Route::get('start-quiz/{id}/{name}', [UserController::class, 'startQuiz']);
Route::post('user-signup', [UserController::class, 'userSignUp']);
Route::view('user-signup', 'user-signup');
Route::get('user-logout', [UserController::class, 'userLogout']);
Route::get('user-signup-quiz', [UserController::class, 'userSignupQuiz']);
Route::view('user-login', 'user-login');
Route::post('user-login', [UserController::class, 'userLogin']);
Route::get('user-login-quiz', [UserController::class, 'userLoginQuiz']);
Route::get('search-quiz', [UserController::class, 'searchQuiz']);

Route::get('verify-user/{email}', [UserController::class, 'verifyUser']);
Route::view('user-forgot-password', 'user-forgot-password');
Route::post('user-forgot-password', [UserController::class, 'userForgotPassword']);
Route::get('user-forgot-password/{email}', [UserController::class, 'userResetForgotPassword']);

Route::middleware('checkUserAuth')->group(function () {
    Route::get('user-details', [UserController::class, 'userDetails']);
    Route::post('mcq/{id}', [UserController::class, 'submitAndNext']);
    Route::get('mcq/{id}/{name}', [UserController::class, 'mcq']);
});


// Admin Route
Route::view('admin-login', 'admin-login');
Route::post('admin-login', [AdminController::class, 'login']);



Route::middleware('checkAdminAuth')->group(function () {
    Route::get('admin-categories', [AdminController::class, 'categories']);
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::get('admin-logout', [AdminController::class, 'logout']);
    Route::post('add-category', [AdminController::class, 'addCategory']);
    Route::get('category/delete/{id}', [AdminController::class, 'deleteCategory']);
    Route::get('add-quiz', [AdminController::class, 'addQuiz']);
    Route::post('add-mcq', [AdminController::class, 'addMCQs']);
    Route::get('end-quiz', [AdminController::class, 'endQuiz']);
    Route::get('show-quiz/{id}/{quizName}', [AdminController::class, 'showQuiz']);
    Route::get('quiz-list/{id}/{category}', [AdminController::class, 'quizList']);
});