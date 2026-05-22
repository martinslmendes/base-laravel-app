<?php

namespace App\Services;

use App\Actions\Teams\CreateTeam;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

readonly class UserService
{
    public function __construct(private CreateTeam $createTeam) {}

    /**
     * @throws Throwable
     */
    public function addUserToTenant(User $user, Tenant $tenant): void
    {
        DB::transaction(function () use ($user, $tenant) {
            tenancy()->initialize($tenant);
            $attributes = $user->getAttributes();
            unset($attributes['current_team_id']);
            $tenantUser = TenantUser::create($attributes);
            $this->createTeam->handle(user: $tenantUser, name: $tenantUser->name."'s Team", isPersonal: true);
        });
    }
}
