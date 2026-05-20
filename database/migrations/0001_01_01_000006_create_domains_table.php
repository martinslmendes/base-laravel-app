<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'domains', callback: function (Blueprint $table) {
            $table->increments(column: 'id');
            $table->string(column: 'domain', length: 255)->unique();
            $table->string(column: 'tenant_id');
            $table->timestamps();
            $table->foreign(columns: 'tenant_id')
                ->references(columns: 'id')
                ->on(table: 'tenants')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
}
