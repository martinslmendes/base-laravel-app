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
        Schema::table(table: 'users', callback: function (Blueprint $table) {
            $table->foreignUuid(column: 'current_team_id')
                ->nullable()
                ->after(column: 'password')
                ->constrained(table: 'teams', column: 'uuid')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(table: 'users', callback: function (Blueprint $table) {
            $table->dropConstrainedForeignId(column: 'current_team_id');
        });
    }
};
