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

        $table->foreignId('client_id')
              ->nullable()
              ->after('title')
              ->constrained('users')
              ->nullOnDelete();

        $table->string('service_location')->nullable()->after('description');

        $table->string('nature_of_work')->nullable()->after('service_location');

        $table->text('billing_address')->nullable()->after('budget');

        $table->enum('invoice_status', [
            'Pending',
            'Generated',
            'Paid'
        ])->default('Pending')->after('status');

        $table->enum('payment_status', [
            'Pending',
            'Partial',
            'Paid'
        ])->default('Pending')->after('invoice_status');

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('projects', function (Blueprint $table) {

        $table->dropForeign(['client_id']);

        $table->dropColumn([
            'client_id',
            'service_location',
            'nature_of_work',
            'billing_address',
            'invoice_status',
            'payment_status'
        ]);

    });
}
};
