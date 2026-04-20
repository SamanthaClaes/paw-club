<?php

use App\Http\Controllers\DayCareController;

Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/daycare', 'pages::daycare')->name('daycare.index');
Route::livewire('/petsitter', 'pages::petsitter')->name('petsitter.index');
