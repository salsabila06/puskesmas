<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FaskesTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\QuestTypeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyResultController;
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

// Route::get('/', function () {
//     return view('layouts.app');
// });


Route::middleware('isLogged')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/daftar', [AuthController::class, 'daftar']);
    Route::post('/', [AuthController::class, 'login']);
    Route::post('/daftar', [AuthController::class, 'regist']);
});
Route::post('/district', DistrictController::class);
Route::post('/faskes-type', FaskesTypeController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index']);

    Route::prefix('parameter-penilaian')->group(function () {
        Route::get('/', [HomeController::class, 'quest_type']);
        Route::post('/', [QuestTypeController::class, 'index']);
        Route::post('/store', [QuestTypeController::class, 'store']);
        Route::post('/update', [QuestTypeController::class, 'update']);
        Route::post('/delete', [QuestTypeController::class, 'destroy']);
        Route::post('/show', [QuestTypeController::class, 'show']);
    });
    Route::prefix('pertanyaan')->group(function () {
        Route::get('/', [HomeController::class, 'quest']);
        Route::post('/', [QuestController::class, 'index']);
        Route::post('/store', [QuestController::class, 'store']);
        Route::post('/update', [QuestController::class, 'update']);
        Route::post('/delete', [QuestController::class, 'destroy']);
        Route::post('/show', [QuestController::class, 'show']);
    });
    Route::prefix('survey')->group(function () {
        Route::get('/', [HomeController::class, 'survey']);
        Route::post('/', [SurveyController::class, 'index']);
        Route::post('/store', [SurveyController::class, 'store']);
        Route::post('/update', [SurveyController::class, 'update']);
        Route::post('/delete', [SurveyController::class, 'destroy']);
        Route::post('/show', [SurveyController::class, 'show']);
    });
    Route::prefix('input-survey')->group(function () {
        Route::get('/', [HomeController::class, 'isi_survey']);
        Route::post('/', SurveyResultController::class);
        Route::get('/{id}', [HomeController::class, 'lets_survey']);
    });


    Route::post('/logout', [AuthController::class, 'logout']);
});
