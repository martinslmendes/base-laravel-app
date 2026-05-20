<?php

namespace App\Models;

use App\Concerns\HasTeams;
use Database\Factories\TenantUserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Stancl\Tenancy\Contracts\Syncable;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;

#[Fillable(['uuid', 'name', 'email', 'email_verified_at', 'password', 'current_team_id', 'two_factor_secret', 'two_factor_recovery_codes', 'two_factor_confirmed_at', 'remember_token', 'deleted_at'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class TenantUser extends Authenticatable implements Syncable
{
    /** @use HasFactory<TenantUserFactory> */
    use HasFactory, HasTeams, HasUuids, Notifiable, ResourceSyncing, SoftDeletes, TwoFactorAuthenticatable;

    protected $primaryKey = 'uuid';
    protected $table = 'users';

    public function getGlobalIdentifierKey()
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'uuid';
    }

    public function getCentralModelName(): string
    {
        return User::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return [
            'name',
            'email',
            'email_verified_at',
            'password',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'two_factor_confirmed_at',
            'remember_token',
            'deleted_at',
        ];
    }

}
