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
        Schema::create('blog_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_author_id')->nullable()->cascadeOnDelete();
            $table->foreignId('blog_category_id')->nullable()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description', 160)->nullable();
            $table->longText('content');
            $table->string('website')->nullable();
            $table->date('published_at')->nullable();
            $table->string('seo_title', 60)->nullable();
            $table->string('seo_description', 160)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_studies');
    }
};
