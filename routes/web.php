<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/index', [\App\Http\Controllers\DivisionGeojsonController::class, 'index'])->name('index');
Route::get('/simple-graph', [\App\Http\Controllers\SimplegraphController::class, 'index'])->name('simple_graph');
Route::get('/simple-bar', [\App\Http\Controllers\SimplegraphController::class, 'simple_chart'])
    ->name('simple_chart');

Route::get('/division', [\App\Http\Controllers\DivisionController::class, 'index'])->name('division');
Route::get('/division-geojson', [\App\Http\Controllers\DivisionController::class, 'div_geojson'])
    ->name('div_geojson');

Route::get('test', [\App\Http\Controllers\TestController::class, 'test'])->name('test');
Route::get('create-data', [\App\Http\Controllers\DivisionController::class, 'create_data'])->name('create_data');

Route::get('line-chart', [TestController::class, 'line_chart']);

Route::get('gmp-index', [\App\Http\Controllers\GmpGirlsController::class, 'index']);
Route::get('gmp_data', [\App\Http\Controllers\GmpGirlsController::class, 'gmp_data']);

Route::get('rfm/all', [\App\Http\Controllers\TestController::class, 'rfm']);


Route::get('yajra-box', [\App\Http\Controllers\TestController::class, 'yajra_box']);
Route::get('yajra-box-data', [\App\Http\Controllers\TestController::class, 'yajra_box_data'])->name('yajra_box_data');

Route::resource('employee', \App\Http\Controllers\EmployeeController::class);
