<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Start ways of apis by passport 
Route::post('register', [RegisterController::class , 'register']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Here you can show all Books REsoueces && make Crud for books field and do you want 
// but don't forget to add Token as bearer in Postman
Route::middleware('api')->group(function () {

    Route::resource('books',BookController::class);
});






