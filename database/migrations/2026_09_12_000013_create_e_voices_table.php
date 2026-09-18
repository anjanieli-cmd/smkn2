<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_voices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ticket_code')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('category')->default('ASPIRASI'); // ASPIRASI, KRITIK, SARAN, PENGADUAN
            $table->unsignedInteger('upvotes_count')->default(0);
            $table->string('status')->default('SUBMITTED'); // SUBMITTED, REVIEWING, IN_PROGRESS, RESOLVED, CLOSED
            $table->timestamps();

            $table->index(['status', 'category']);
            $table->index(['upvotes_count']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_voices');
    }
};
