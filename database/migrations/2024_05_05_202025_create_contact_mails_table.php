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
        Schema::create('contact_mails', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['Technology', 'Marketing', 'Design', 'Photography', 'Art'])->nullable();
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->string('compnany')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->text('message')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_mails');
    }
};
