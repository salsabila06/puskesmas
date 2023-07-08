<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartCluster;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FaskesController;
use App\Http\Controllers\FaskesTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\QuestTypeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyForFaskesController;
use App\Http\Controllers\SurveyResultController;
use App\Http\Controllers\SurveyResultFaskesController;
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

Route::get('/cluster', ClusterController::class);

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
    Route::prefix('puskesmas')->group(function () {
        Route::get('/', [HomeController::class, 'faskes']);
        Route::post('/', [FaskesController::class, 'index']);
        Route::post('/store', [FaskesController::class, 'store']);
        Route::post('/update', [FaskesController::class, 'update']);
        Route::post('/delete', [FaskesController::class, 'destroy']);
        Route::post('/show', [FaskesController::class, 'show']);
    });
    Route::prefix('survey')->group(function () {
        Route::get('/', [HomeController::class, 'survey']);
        Route::post('/', [SurveyController::class, 'index']);
        Route::post('/store', [SurveyController::class, 'store']);
        Route::post('/update', [SurveyController::class, 'update']);
        Route::post('/delete', [SurveyController::class, 'destroy']);
        Route::post('/show', [SurveyController::class, 'show']);
        Route::post('/for-faskes', SurveyForFaskesController::class);
    });
    Route::prefix('input-survey')->group(function () {
        Route::get('/', [HomeController::class, 'isi_survey']);
        Route::post('/', SurveyResultController::class);
        Route::get('/{id}', [HomeController::class, 'lets_survey']);
    });
    Route::prefix('result')->group(function () {
        Route::post('/', [SurveyResultFaskesController::class, 'show']);
        Route::get('/', [HomeController::class, 'hasil_survey']);
        Route::get('/{id}', [HomeController::class, 'hasil_survey_detail']);
    });
    Route::prefix('cluster')->group(function () {
        Route::post('/', ClusterController::class);
        Route::post('/chart', ChartCluster::class);
    });
    Route::prefix('hasil-clustering')->group(function () {
        Route::get('/', [HomeController::class, 'hasil_cluster']);
        Route::get('/{id}', [HomeController::class, 'hasil_cluster_detail']);
    });


    Route::post('/logout', [AuthController::class, 'logout']);
});
