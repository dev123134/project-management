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
    Schema::table('projects', function (Blueprint $table) {
        if (!Schema::hasColumn('projects', 'start_date')) {
            $table->date('start_date')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('projects', function (Blueprint $table) {
        if (Schema::hasColumn('projects', 'start_date')) {
            $table->dropColumn('start_date');
        }
    });
}
};
