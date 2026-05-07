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
        Schema::create(table: 'teams', callback: function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string(column: 'name');
            $table->string(column: 'slug')->unique();
            $table->boolean(column: 'is_personal')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(table: 'team_members', callback: function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid(column: 'team_id')->constrained(table: 'teams', column: 'uuid')->cascadeOnDelete();
            $table->foreignUuid(column: 'user_id')->constrained(table: 'users', column: 'uuid')->cascadeOnDelete();
            $table->string(column: 'role');
            $table->timestamps();

            $table->unique(['team_id', 'user_id']);
        });

        Schema::create(table: 'team_invitations', callback: function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string(column: 'code', length: 64)->unique();
            $table->foreignUuid(column: 'team_id')->constrained(table: 'teams', column: 'uuid')->cascadeOnDelete();
            $table->string(column: 'email');
            $table->string(column: 'role');
            $table->foreignUuid(column: 'invited_by')->constrained(table: 'users', column: 'uuid')->cascadeOnDelete();
            $table->timestamp(column: 'expires_at')->nullable();
            $table->timestamp(column: 'accepted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'team_invitations');
        Schema::dropIfExists(table: 'team_members');
        Schema::dropIfExists(table: 'teams');
    }
};
