<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

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

Route::get('/', function () {
    return view('admin.dashboard');
});
Route::get('/add-bill',[BillController::class,'add_bill']);
Route::get('/all-bill',[BillController::class,'all_bill']);
Route::post('/save-bill',[BillController::class,'save_bill']);
Route::get('/export-invoice/{id}',[BillController::class,'export_invoice']);

