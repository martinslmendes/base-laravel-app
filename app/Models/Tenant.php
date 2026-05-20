<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, SoftDeletes;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class,
            table: 'tenant_users',
            foreignPivotKey: 'tenant_id',
            relatedPivotKey: 'user_id',
            parentKey: 'id',
            relatedKey: 'uuid'
        )->using(class: TenantPivot::class);
    }
}
