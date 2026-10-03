<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_industry_logos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');                       // path relatif dari folder public, mis. images/industri/hummatech.png
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_industry_logos');
    }
};
