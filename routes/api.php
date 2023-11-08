<?php

use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewsController;

Route::middleware(['auth:api', CheckClientCredentials::class])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books/category/personal-development',[BookController::class, 'getPersonalDevelopmentBooks']);
Route::get('/books/category/love',[BookController::class, 'getLoveBooks']);
Route::get('/books/category/health',[BookController::class, 'getHealthBooks']);
Route::get('/books/category/medical',[BookController::class, 'getMedicalBooks']);

Route::get('/all-books',[CategoryController::class, 'index']);
Route::get('/student-reviews', [ReviewsController::class, 'getStudentReviews']);
Route::post('/book/review', [ReviewsController::class, 'addReview']);


    Route::post('/register', [StudentController::class, 'register']);
    Route::post('/login', [StudentController::class, 'login']);

    Route::group(['middleware' => 'jwt.verify'], static function ($router) {
        Route::post('logout', 'MemberController@logout');
        Route::post('refresh', 'MemberController@refresh');
        Route::get('detail', 'MemberController@detail');
    });

