<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Models\TenantPivot as BaseTenantPivot;

class TenantPivot extends BaseTenantPivot
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    protected $table = 'tenant_users';

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
            ownerKey: 'uuid',
            relation: 'users'
        );
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(
            related: Tenant::class,
            foreignKey: 'tenant_id',
            ownerKey: 'id',
            relation: 'tenants'
        );
    }
}
