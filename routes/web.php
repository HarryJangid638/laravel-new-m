<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\AuthController;
Route::get('/', function ()
{
    return view('front.home.index');
});




