<?php

use App\Http\Controllers\DayCareController;

Route::livewire('/', 'pages::home')->name('home');


Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['fr' , 'en'])) {
        abort(400);
    }

    Session::put('locale', $locale);

    return redirect()->back();
})->name('language.switch');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard.index');

    Route::livewire('/dashboard/petsitter', 'pages::dashboard.petsitter')->name('dashboard.petsitter');

    Route::livewire('/dashboard/dogs', 'pages::dashboard.dogs')->name('dashboard.dogs');

    Route::livewire('/dashboard/messages', 'pages::dashboard.messages')->name('dashboard.messages');

    Route::livewire('/dashboard/request', 'pages::dashboard.request')->name('dashboard.request');

});
Route::middleware('auth')->group(function () {
    Route::livewire('/petsitter/request', 'pages::petsitter.request')->name('petsitter.request');
    Route::livewire('/petsitter/profile', 'pages::petsitter.profile')->name('petsitter.profile');
    Route::livewire('/petsitter/planning', 'pages::petsitter.planning')->name('petsitter.planning');
    Route::livewire('/petsitter/history', 'pages::petsitter.history')->name('petsitter.history');
    Route::livewire('/owner/profile', 'pages::owner.profile')->name('owner.profile');
    Route::livewire('/daycare/request', 'pages::daycare.request')->name('daycare.request');

});
Route::livewire('/daycare', 'pages::daycare')->name('daycare.index');
Route::livewire('/daycare/create', 'pages::daycare.create')->name('daycare.create');
Route::livewire('/petsitter', 'pages::petsitter')->name('petsitter.index');
Route::livewire('/petsitter/booking/create/{user}', 'pages::petsitter.booking.create')->name('petsitter.booking.create');
Route::livewire('/petsitter/create', 'pages::petsitter.create')->name('petsitter.create');
Route::livewire('/petsitter/contact/{user}', 'pages::petsitter.booking.contact-form')->name('petsitter.contact');
Route::livewire('/terms', 'pages::legal.terms')->name('terms');
Route::livewire('/confidentiality', 'pages::legal.confidentiality')->name('confidentiality');

