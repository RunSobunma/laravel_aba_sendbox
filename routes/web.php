<?php

use App\Http\Controllers\PaymentController;
use App\Services\PaywayService;
use Illuminate\Support\Facades\Route;

Route::post('/Checkoutbox', [PaymentController::class , 'ChekoutForm'])->name('Checkout');

Route::get('/', function (){
    return view('Order');
});
