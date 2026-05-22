<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

#[Fillable(['name'])]
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

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'created_at',
            'updated_at',
        ];
    }
}
