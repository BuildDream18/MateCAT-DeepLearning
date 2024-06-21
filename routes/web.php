<?php

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


$mainRoutes = function () {

    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/contact-us', function () {
        return view('contact-us');
    })->name('contact-us');

    Route::get('/type-of-translators', function () {
        return view('type-of-translators');
    })->name('type-of-translators');

    Route::get('/our-vetting-process', function () {
        return view('our-vetting-process');
    })->name('our-vetting-process');

    Route::get('/outsource-your-translations', function () {
        return view('outsource-your-translations');
    })->name('outsource-your-translations');

    Route::get('/how-do-we-work', function () {
        return view('how-do-we-work');
    })->name('how-do-we-work');


    require __DIR__.'/auth.php';


    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
};

$aiRoutes = function () {


    Route::get('/', [\App\Http\Controllers\AiController::class, 'index'])->name('ai-home');
    Route::post('/new-project', [\App\Http\Controllers\AiController::class, 'newProject'])->name('new-project');
    Route::get('/summary/{hash}', [\App\Http\Controllers\AiController::class, 'summary'])->name('summary');
    Route::get('/download-file', [\App\Http\Controllers\AiController::class, 'downloadFile'])->name('download-file');
    Route::get('/hire-translator/{hash}', [\App\Http\Controllers\AiController::class, 'hireTranslator'])->name('hire-translator');
    Route::post('/hire-translator/{hash}', [\App\Http\Controllers\AiController::class, 'actionHireTranslator'])->name('hire-translator');
};

if (config('app.app_localhost')) {
    Route::group(array('domain' => 'localhost'), $mainRoutes);
    Route::group(array('domain' => 'ai.localhost'), $aiRoutes);
} else {
    Route::group(array('domain' => 'www.aitranslationhub.co'), $mainRoutes);
    Route::group(array('domain' => 'aitranslationhub.co'), $mainRoutes);
    Route::group(array('domain' => 'ai.aitranslationhub.co'), $aiRoutes);
}



