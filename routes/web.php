<?php

use Illuminate\Support\Facades\Route;
use Vrnvgasu\Localization\Controllers\LocaleController;

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

Route::get('/vrnvgasu/locales/change/{locale}', [LocaleController::class, 'change'])
    ->middleware('web')
    ->name('vrnvgasu.locales.change');

