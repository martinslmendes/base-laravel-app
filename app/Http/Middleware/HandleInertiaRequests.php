<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        $locale = $request->header('locale', config('app.locale'));

        $map = [
            'pt' => 'pt_BR',
            'pt-BR' => 'pt_BR',
            'pt-br' => 'pt_BR',
        ];

        if (array_key_exists($locale, $map)) {
            $locale = $map[$locale];
        }

        App::setLocale($locale);

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $user,
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'currentTeam' => fn () => $user?->currentTeam ? $user->toUserTeam($user->currentTeam) : null,
            'currentTenant' => fn () => tenancy()->tenant,
            'teams' => fn () => $user?->toUserTeams(includeCurrent: true) ?? [],
            'tenants' => fn () => $user?->tenants()->get(),
        ];
    }
}
