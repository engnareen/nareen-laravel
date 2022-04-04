

<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CounrtyController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\GallaryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SklillController;
use App\Http\Controllers\Admin\WorksController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\PlansController;

use App\Models\Team;
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
/* ====== Profile =======*/

Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile', [ProfileController::class, 'update']);
Route::post('profile/remove-image', [ProfileController::class, 'remove_image'])->name('profile.remove_image');


/* ====== Settings =======*/
Route::get('settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
Route::patch('settings/edit', [SettingsController::class, 'update'])->name('settings.update');


// Route:: Countries
Route::get('country-list', [CounrtyController::class, 'index'])->name('country-list');
Route::post('/add-country',[CounrtyController::class,'addCountry'])->name('add.country');
Route::get('/getCountriesList',[CounrtyController::class, 'getCountriesList'])->name('get.countries.list');
Route::post('/getCountryDetails',[CounrtyController::class, 'getCountryDetails'])->name('get.country.details');
Route::post('/updateCountryDetails',[CounrtyController::class, 'updateCountryDetails'])->name('update.country.details');
Route::post('/deleteCountry',[CounrtyController::class,'deleteCountry'])->name('delete.country');
Route::post('/deleteSelectedCountries',[CounrtyController::class,'deleteSelectedCountries'])->name('delete.selected.countries');

//Teams
Route::group([
    'prefix' => 'admin',
    //'as' => 'article.',
    'middleware' => ['auth'],

], function(){
Route::get('teams', [TeamController::class , 'index'])->name('admin/teams');
Route::post('/save',[TeamController::class,'save'])->name('save.teams');
Route::get('/fetchTeams',[TeamController::class,'fetchTeams'])->name('fetch.teams');
Route::get('/getTeamDetails',[TeamController::class,'getTeamDetails'])->name('get.team.details');
Route::post('/updateTeam',[TeamController::class,'updateTeam'])->name('update.team');
Route::post('/deleteMember',[TeamController::class,'deleteMember'])->name('delete.member');

Route::get('gallary', [GallaryController::class , 'index'])->name('admin/gallary');
Route::post('/saveGallary',[GallaryController::class,'saveGallary'])->name('save.gallary');
Route::get('/fetchGallary',[GallaryController::class,'fetchGallary'])->name('fetch.gallary');
Route::get('/getGallaryDetails',[GallaryController::class,'getGallaryDetails'])->name('get.gallary.details');
Route::post('/updateGallary',[GallaryController::class,'updateGallary'])->name('update.gallary');
Route::post('/deleteGallary',[GallaryController::class,'deleteGallary'])->name('delete.gallary');

});

// services
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth'],
], function(){
    Route::get('service-list', [ServiceController::class, 'index'])->name('service-list');
    Route::post('/add-service',[ServiceController::class,'addService'])->name('add.service');
    Route::get('/getServicesList',[ServiceController::class, 'getServicesList'])->name('get.services.list');
    Route::post('/getServiceDetails',[ServiceController::class, 'getServiceDetails'])->name('get.service.details');
    Route::post('/updateServiceDetails',[ServiceController::class, 'updateServiceDetails'])->name('update.service.details');
    Route::post('/deleteService',[ServiceController::class,'deleteService'])->name('delete.service');
    Route::post('/deleteSelectedServices',[ServiceController::class,'deleteSelectedServices'])->name('delete.selected.services');


    // skills

    Route::get('skill-list', [SklillController::class, 'index'])->name('skill-list');
    Route::post('/add-skill',[SklillController::class,'addSkill'])->name('add.skill');
    Route::get('/getSkillsList',[SklillController::class, 'getSkillsList'])->name('get.skills.list');
    Route::post('/getSkillDetails',[SklillController::class, 'getSkillsDetails'])->name('get.skill.details');
    Route::post('/updateSkillDetails',[SklillController::class, 'updateSkillDetails'])->name('update.skill.details');
    Route::post('/deleteSkill',[SklillController::class,'deleteSkill'])->name('delete.skill');
    Route::post('/deleteSelectedSkills',[SklillController::class,'deleteSelectedSkills'])->name('delete.selected.skills');

    /// Events
    Route::get('/events', [EventsController::class , 'index'])->name('event.index');
    Route::get('/createEvent', [EventsController::class, 'createEvent'])->name('event.create');
    Route::post('/add-event', [EventsController::class, 'storeEvent'])->name('event.store');
    Route::get('/event/{event}', [EventsController::class, 'editEvent'])->name('event.edit');
    Route::put('/event/{event}', [EventsController::class, 'updateEvent'])->name('event.update');
    Route::delete('event/{id}', [EventsController::class, 'destroyEvent'])->name('event.destroy');
    Route::post('event/remove-image', [EventsController::class, 'remove_image'])->name('remove_image');


    /// Features
    Route::get('/features', [FeaturesController::class , 'index'])->name('feature.index');
    Route::get('/createFeature', [FeaturesController::class, 'createFeature'])->name('feature.create');
    Route::post('/add-feature', [FeaturesController::class, 'storeFeature'])->name('feature.store');
    Route::get('/feature/{feature}', [FeaturesController::class, 'editFeature'])->name('feature.edit');
    Route::put('/feature/{feature}', [FeaturesController::class, 'updateFeature'])->name('feature.update');
    Route::delete('feature/{id}', [FeaturesController::class, 'destroyFeature'])->name('feature.destroy');
    Route::post('feature/remove-image', [FeaturesController::class, 'remove_image'])->name('feature.remove_image');

    /// Works
    Route::get('/works', [WorksController::class , 'index'])->name('work.index');
    Route::get('/createWork', [WorksController::class, 'createWork'])->name('work.create');
    Route::post('/add-work', [WorksController::class, 'storeWork'])->name('work.store');
    Route::get('/work/{work}', [WorksController::class, 'editWork'])->name('work.edit');
    Route::put('/work/{work}', [WorksController::class, 'updateWork'])->name('work.update');
    Route::delete('work/{id}', [WorksController::class, 'destroyWork'])->name('work.destroy');
    Route::post('work/remove-image', [WorksController::class, 'remove_image'])->name('work.remove_image');

    // Tags
    Route::get('/tags', [TagsController::class , 'index'])->name('tag.index');
    Route::get('/createTag', [TagsController::class, 'createTag'])->name('tag.create');
    Route::post('/add-tag', [TagsController::class, 'storeTag'])->name('tag.store');
    Route::get('/tag/{tag}', [TagsController::class, 'editTag'])->name('tag.edit');
    Route::put('/tag/{tag}', [TagsController::class, 'updateTag'])->name('tag.update');
    Route::delete('tag/{id}', [TagsController::class, 'destroyTag'])->name('tag.destroy');

    // Plans
    Route::get('/plans', [PlansController::class , 'index'])->name('plan.index');
    Route::get('/createPlan', [PlansController::class, 'createPlan'])->name('plan.create');
    Route::post('/add-plan', [PlansController::class, 'storePlan'])->name('plan.store');
    Route::get('/plan/{plan}', [PlansController::class, 'editPlan'])->name('plan.edit');
    Route::put('/plan/{plan}', [PlansController::class, 'updatePlan'])->name('plan.update');
    Route::delete('plan/{id}', [PlansController::class, 'destroyPlan'])->name('plan.destroy');
    Route::post('plan/remove-image', [PlansController::class, 'remove_image'])->name('plan.remove_image');

});
