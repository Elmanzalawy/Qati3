<?php

use App\Livewire\Article\ArticleEditor;
use App\Livewire\Article\ListArticles;
use App\Livewire\Article\ViewArticle;
use App\Livewire\Brand\BrandEditor;
use App\Livewire\Brand\ListBrands;
use App\Livewire\Brand\ViewBrand;
use App\Livewire\Category\CategoryEditor;
use App\Livewire\Category\ListCategories;
use App\Models\Category;
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
        Route::get('{slug}', ViewArticle::class)->name('show');
    });
});

Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
    Route::get('', ListBrands::class)->name('index');
    Route::get('{slug}', ViewBrand::class)->name('show');
});

Route::group(['prefix' => 'articles', 'as' => 'articles.'], function () {
    Route::get('', ListArticles::class)->name('index');
    Route::get('{slug}', ViewArticle::class)->name('show');
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('', ListCategories::class)->name('index');
    Route::get('new', CategoryEditor::class)->name('create');
    Route::get('{slug}/edit', CategoryEditor::class)->name('edit');
});

require __DIR__.'/auth.php';
