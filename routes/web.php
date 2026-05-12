<?php

use App\Http\Controllers\DayCareController;

Route::livewire('/', 'pages::home')->name('home');
Route::middleware('auth')->group(function () {
    Route::livewire('/daycare', 'pages::daycare')->name('daycare.index');
});

Route::livewire('/daycare/create', 'pages::daycare.create')->name('daycare.create');
Route::livewire('/petsitter', 'pages::petsitter')->name('petsitter.index');
Route::livewire('/petsitter/create', 'pages::petsitter.create')->name('petsitter.create');
Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard.index');
Route::livewire('/dashboard/petsitter', 'pages::dashboard.petsitter')->name('dashboard.petsitter');
Route::livewire('/dashboard/dogs', 'pages::dashboard.dogs')->name('dashboard.dogs');
Route::livewire('/dashboard/messages', 'pages::dashboard.messages')->name('dashboard.messages');
Route::livewire('/dashboard/request', 'pages::dashboard.request')->name('dashboard.request');
