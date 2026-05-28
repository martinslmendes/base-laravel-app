<?php

use App\Http\Controllers\Central\UserController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

Route::middleware(['universal', InitializeTenancyByRequestData::class])->group(function () {
    Route::inertia('/', 'welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ])->name('home');

    Route::prefix('{current_team}')
        ->middleware(['auth', 'verified', EnsureTeamMembership::class])
        ->group(function () {
            Route::inertia('dashboard', 'dashboard')->name('dashboard');
            Route::resource(name: 'users', controller: UserController::class)->except(['show']);
        });

    Route::middleware(['auth'])->group(function () {
        Route::get('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
    });

    require __DIR__.'/settings.php';
});
