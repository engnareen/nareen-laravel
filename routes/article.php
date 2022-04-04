
<?php

use App\Http\Controllers\Admin\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'article',
    'as' => 'article.',
    'middleware' => ['auth'],

], function(){
        //Route::resource('artilces', ArticlesController::class);


        Route::get('/', [ArticlesController::class , 'index'])->name('index');
        Route::get('/create', [ArticlesController::class, 'create'])->name('create');
        Route::post('', [ArticlesController::class, 'store'])->name('store');
        Route::get('/{article}', [ArticlesController::class, 'edit'])->name('edit');
        Route::put('/{article}', [ArticlesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ArticlesController::class, 'destroy'])->name('destroy');

        Route::post('/remove-image', [ArticlesController::class, 'remove_image'])->name('remove_image');


        // Route::get('/', [ArticlesController::class , 'getAllArticles'])->name('getAllArticles');




});
