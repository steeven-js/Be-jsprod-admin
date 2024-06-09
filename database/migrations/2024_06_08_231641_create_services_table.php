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
        Schema::create('shop_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('is_visible')->default(true);
            $table->enum('license', ['Standard', 'Plus', 'Extended'])->default('Standard');
            $table->decimal('price', 6, 2)->nullable();
            $table->decimal('priceSale', 6, 2)->nullable();
            $table->string('caption')->nullable();
            $table->decimal('ratingNumber', 2, 1)->nullable();
            $table->integer('totalReviews')->nullable();
            $table->text('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->json('commons')->nullable();
            $table->json('options')->nullable();
            $table->json('specifications')->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
