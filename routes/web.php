<?php

use App\Livewire\Article\ArticleEditor;
use App\Livewire\Article\ListArticles;
use App\Livewire\Article\ViewArticle;
use App\Livewire\Brand\BrandEditor;
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

Route::view('/', 'index')->name('index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function(){
    Route::group(['prefix' => 'brands', 'as' => 'brands.'], function(){
        Route::get('new', BrandEditor::class)->name('create');
        Route::get('{slug}/edit', BrandEditor::class)->name('edit');
    });


    Route::group(['prefix' => 'articles', 'as' => 'articles.'], function(){
        Route::get('', ListArticles::class)->name('index');
        Route::get('new', ArticleEditor::class)->name('create');
        Route::get('{slug}', ViewArticle::class)->name('show');
        Route::get('{slug}/edit', ArticleEditor::class)->name('edit');
    });
});

require __DIR__.'/auth.php';
