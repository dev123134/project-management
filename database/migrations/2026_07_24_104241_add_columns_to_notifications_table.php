<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            $table->text('message')->after('title');

            $table->string('type')
                  ->default('general')
                  ->after('message');

            $table->string('icon')
                  ->nullable()
                  ->after('type');

            $table->string('color')
                  ->default('primary')
                  ->after('icon');

            $table->string('url')
                  ->nullable()
                  ->after('color');

            $table->timestamp('read_at')
                  ->nullable()
                  ->after('is_read');

        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            $table->dropColumn([
                'message',
                'type',
                'icon',
                'color',
                'url',
                'read_at',
            ]);

        });
    }
};