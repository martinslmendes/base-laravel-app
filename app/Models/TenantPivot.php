<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TenantPivot extends Pivot
{
    use HasUuids;

    protected $primaryKey = 'uuid';
}
