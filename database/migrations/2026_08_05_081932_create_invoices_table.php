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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();

        // Project Relation
        $table->foreignId('project_id')->constrained()->onDelete('cascade');

        // Invoice Details
        $table->string('invoice_number')->unique();
        $table->date('invoice_date');
        $table->date('due_date');

        // Amount Details
        $table->decimal('subtotal', 12, 2)->default(0);
        $table->decimal('tax_percentage', 5, 2)->default(0);
        $table->decimal('tax_amount', 12, 2)->default(0);
        $table->decimal('discount', 12, 2)->default(0);
        $table->decimal('grand_total', 12, 2)->default(0);

        // Status
        $table->enum('status', [
            'Draft',
            'Sent',
            'Partial',
            'Paid',
            'Overdue'
        ])->default('Draft');

        // Optional Notes
        $table->text('notes')->nullable();

        // User who created invoice
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
