<?php

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

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/project', function () {
    return view('frontend.project');
});

Route::get('/resume', function () {
    return view('frontend.resume');
});

Route::get('/subscribe', function () {
    return view('frontend.subscribe');
});

Route::get('/article', function () {
    return view('frontend.article');
});

Route::get('/a-post', function () {
    return view('frontend.a-post');
});