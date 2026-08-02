<?php


Route::redirect('/', '/fr');

Route::get('/lang/{locale}', function (string $locale) {

    if (! in_array($locale, ['fr', 'en'])) {
        abort(400);
    }

    Session::put('locale', $locale);

    $previous = url()->previous();

    $previous = preg_replace(
        '#/(fr|en)#',
        '/' . $locale,
        $previous,
        1
    );

    return redirect($previous);

})->name('language.switch');

Route::prefix('{locale}')->group(function () {

    Route::livewire('/', 'pages::home')->name('home');

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard.index');

        Route::livewire('/dashboard/petsitter', 'pages::dashboard.petsitter')->name('dashboard.petsitter');

        Route::livewire('/dashboard/dogs', 'pages::dashboard.dogs')->name('dashboard.dogs');

        Route::livewire('/dashboard/messages', 'pages::dashboard.messages')->name('dashboard.messages');

        Route::livewire('/dashboard/request', 'pages::dashboard.request')->name('dashboard.request');

    });

    Route::middleware('auth')->group(function () {

        Route::livewire('/user/request', 'pages::user.request')->name('user.request');
        Route::livewire('/profile', 'pages::profile')->name('profile');
        Route::livewire('/user/history', 'pages::user.history')->name('user.history');
        Route::livewire('/daycare/request', 'pages::daycare.request')->name('daycare.request');
        Route::livewire('/petsitter/contact/{user}', 'pages::petsitter.booking.contact-form')
            ->name('petsitter.contact');
        Route::livewire('/petsitter/booking/create/{user}', 'pages::petsitter.booking.create')
            ->name('petsitter.booking.create');

    });
    Route::middleware(['auth', 'petsitter'])->group(function () {
        Route::livewire('/petsitter/planning', 'pages::petsitter.planning')->name('petsitter.planning');
        Route::livewire('/petsitter/history', 'pages::petsitter.history')->name('petsitter.history');
        Route::livewire('/petsitter/messages', 'pages::petsitter.messages')->name('petsitter.messages');
        Route::livewire('/petsitter/request', 'pages::petsitter.request')->name('petsitter.request');

    });

    Route::livewire('/daycare', 'pages::daycare')->name('daycare.index');

    Route::livewire('/daycare/create', 'pages::daycare.create')->name('daycare.create');

    Route::livewire('/petsitter', 'pages::petsitter')->name('petsitter.index');

    Route::livewire('/petsitter/create', 'pages::petsitter.create')->name('petsitter.create');

    Route::livewire('/terms', 'pages::legal.terms')->name('terms');

    Route::livewire('/confidentiality', 'pages::legal.confidentiality')->name('confidentiality');

});
