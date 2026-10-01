<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('visi_misi_items')) {
            return;
        }

        Schema::create('visi_misi_items', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20)->index();      // misi | tujuan | nilai
            $table->string('icon', 60)->nullable();   // class FontAwesome tanpa "fas ", mis. fa-book-open
            $table->string('title');
            $table->text('text')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visi_misi_items');
    }
};
