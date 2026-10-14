<?php

/*
    Nama file   : web.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

  
use App\Http\Controllers\BerandaController; 
use Illuminate\Support\Facades\Route; 

  Route::get('/', function () { 
    return view('welcome'); 
}); 
  
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
