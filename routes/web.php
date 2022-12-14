<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\RoleController;
use App\Http\Controllers\CMS\UsersController;
use App\Http\Controllers\CMS\FeatureController;
use App\Http\Controllers\CMS\ServicesController;
use App\Http\Controllers\CMS\PageSliderController;
use App\Http\Controllers\CMS\GallerieController;
use App\Http\Controllers\CMS\ExperienceController;
use App\Http\Controllers\CMS\ProductController;
use App\Http\Controllers\CMS\VillasController;
use App\Http\Controllers\CMS\RatingController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index']);
Route::get('/our-villa', [MainController::class, 'listVilla']);
Route::get('/our-villa/{slug}', [MainController::class, 'detailVilla'])->name('villa.detail');
Route::get('/dinings', [MainController::class, 'dining']);
Route::get('/menaka-spa', [MainController::class, 'spa']);
Route::get('/weddings', [MainController::class, 'wedding']);
Route::get('/weddings/{slug}', [MainController::class, 'detailWedding'])->name('weddings.detail');
Route::get('/offers', [MainController::class, 'offers']);
Route::get('/offers/{slug}', [MainController::class, 'detailOffers'])->name('offers.detail');
Route::get('/experience', [MainController::class, 'experience']);
Route::get('/experience/{slug}', [MainController::class, 'detailExperience'])->name('experience.detail');
Route::get('/gallery', [MainController::class, 'gallery']);
Route::get('/contact-us', [MainController::class, 'contact']);
Route::post('/send-mail', [MainController::class, 'sendMail']);
Auth::routes();

Route::group([
    'name' => 'dashboard',
    'prefix' => 'dashboard',
    'middleware' => 'auth'
], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('roles', CMS\RoleController::class);
    Route::get('roles/destroy/{id}', [RoleController::class, 'destroy']);
    Route::resource('users', CMS\UsersController::class);
    Route::get('users/destroy/{id}', [UsersController::class, 'destroy']);
    // villa
    Route::resource('villa', CMS\VillasController::class);
    Route::get('/villa/edit/{id}', [VillasController::class, 'edit'])->name('villa.edit');
    Route::put('/villa/update/{id}', [VillasController::class, 'update'])->name('villa.update');
    Route::get('/villa/destroy/{id}', [VillasController::class, 'destroy'])->name('villa.delete');
    // feature villa
    Route::get('/villas/room-feature', [FeatureController::class, 'index']);
    Route::post('/villas/room-feature/store', [FeatureController::class, 'store']);
    Route::get('/villas/room-feature/edit/{id}', [FeatureController::class, 'edit']);
    Route::get('/villas/room-feature/destroy/{id}', [FeatureController::class, 'destroy']);
    // service villa
    Route::get('/villas/room-service', [ServicesController::class, 'index']);
    Route::post('/villas/room-service/store', [ServicesController::class, 'store']);
    Route::get('/villas/room-service/edit/{id}', [ServicesController::class, 'edit']);
    Route::get('/villas/room-service/destroy/{id}', [ServicesController::class, 'destroy']);
    // page sliders
    Route::get('/sliders', [PageSliderController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [PageSliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliders/store', [PageSliderController::class, 'store'])->name('sliders.store');
    Route::post('/sliders/store/media', [PageSliderController::class, 'storeMedia'])->name('sliders.storeMedia');
    Route::get('/sliders/edit/{id}', [PageSliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/update/{id}', [PageSliderController::class, 'update'])->name('sliders.update');
    Route::get('/sliders/destroy/{id}', [PageSliderController::class, 'destroy'])->name('sliders.delete');
    // settings
    Route::resource('settings', CMS\SettingController::class);
    // gallery
    Route::get('/gallery', [GallerieController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GallerieController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [GallerieController::class, 'store'])->name('gallery.store');
    Route::post('/gallery/store/media', [GallerieController::class, 'storeMedia'])->name('gallery.storeMedia');
    Route::get('/gallery/edit/{id}', [GallerieController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/update/{id}', [GallerieController::class, 'update'])->name('gallery.update');
    Route::get('/gallery/destroy/{id}', [GallerieController::class, 'destroy'])->name('gallery.delete');
    // experience
    Route::get('/experience', [ExperienceController::class, 'index'])->name('experience.index');
    Route::get('/experience/create', [ExperienceController::class, 'create'])->name('experience.create');
    Route::post('/experience/store', [ExperienceController::class, 'store'])->name('experience.store');
    Route::post('/experience/store/media', [ExperienceController::class, 'storeMedia'])->name('experience.storeMedia');
    Route::get('/experience/edit/{id}', [ExperienceController::class, 'edit'])->name('experience.edit');
    Route::put('/experience/update/{id}', [ExperienceController::class, 'update'])->name('experience.update');
    Route::get('/experience/destroy/{id}', [ExperienceController::class, 'destroy'])->name('experience.delete');
    // wedding & offers
    Route::get('/wedding', [ProductController::class, 'weddingList'])->name('wedding.index');
    Route::get('/offers', [ProductController::class, 'offersList'])->name('offers.index');

    Route::get('/wedding/create', [ProductController::class, 'createWedding'])->name('wedding.create');
    Route::get('/offers/create', [ProductController::class, 'createOffer'])->name('offers.create');

    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::post('/product/store/media', [ProductController::class, 'storeMedia'])->name('product.storeMedia');

    Route::get('/wedding/edit/{id}', [ProductController::class, 'editWedding'])->name('wedding.edit');
    Route::get('/offers/edit/{id}', [ProductController::class, 'editOffer'])->name('offers.edit');

    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    // ratings
    Route::get('/reviews', [RatingController::class, 'index']);
    Route::post('/reviews/store', [RatingController::class, 'store']);
    Route::get('/reviews/edit/{id}', [RatingController::class, 'edit']);
    Route::get('/reviews/destroy/{id}', [RatingController::class, 'destroy']);


});
