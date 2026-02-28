<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Display name, e.g. "Kemenag Bantul"
            $table->string('code')->unique();    // Slug, e.g. "kemenag_bantul"
            $table->string('domain')->nullable(); // e.g. "bantul.kemenag.go.id"
            $table->string('category')->default('news_portal'); // social_media or news_portal
            $table->string('icon')->default('heroicon-o-document-text');
            $table->string('title_selector')->nullable();  // CSS selector for title
            $table->string('date_selector')->nullable();   // CSS selector for date
            $table->string('date_format')->nullable();     // PHP date format e.g. "m/d/Y"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
