<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $tenant_ids = ['foo', 'bar'];

        foreach ($tenant_ids as $tenant_id) {
            $tenant = Tenant::create([
                'id' => $tenant_id,
                'name' => $tenant_id,
            ]);
            $tenant->domains()->create(['domain' => $tenant_id]);
        }
    }
}
