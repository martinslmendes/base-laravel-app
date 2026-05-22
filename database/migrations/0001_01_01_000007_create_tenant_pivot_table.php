<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'tenant_users', callback: function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string(column: 'tenant_id');
            $table->foreignUuid(column: 'user_id')
                ->constrained(table: 'users', column: 'uuid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['tenant_id', 'user_id']);

            $table->foreign(columns: 'tenant_id')
                ->references(columns: 'id')
                ->on(table: 'tenants')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'tenant_users');
    }
};
