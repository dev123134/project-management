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
    Schema::create('meetings', function (Blueprint $table) {

        $table->id();

        $table->string('meeting_title');

        $table->text('meeting_description')->nullable();

        $table->string('meeting_link');

        $table->string('meeting_password')->nullable();

        $table->date('meeting_date');

        $table->time('meeting_time');

        $table->integer('duration')->default(30);

        $table->foreignId('created_by')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->enum('status', [
            'upcoming',
            'completed',
            'cancelled'
        ])->default('upcoming');

        $table->softDeletes();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
