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
            $table->string('company');
            $table->string('email')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->text('message');
            $table->string('phoneNumber');
            $table->string('website');
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
