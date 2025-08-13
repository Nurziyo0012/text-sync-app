<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextRowController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('textrows', TextRowController::class);
Route::get('/textrows', [TextRowController::class, 'index'])->name('textrows.index');

Route::post('/textrows/generate', [TextRowController::class, 'generate'])->name('textrows.generate');
Route::delete('/textrows/clear', [TextRowController::class, 'clear'])->name('textrows.clear');
Route::post('/textrows/import', [TextRowController::class, 'import'])->name('textrows.import');

Route::post('/generate', [TextRowController::class, 'generate'])->name('generate');
Route::post('/clear', [TextRowController::class, 'clear'])->name('clear');
Route::post('/import', [TextRowController::class, 'import'])->name('import');

Route::get('/test-sheet', [TextRowController::class, 'testSheet']);
