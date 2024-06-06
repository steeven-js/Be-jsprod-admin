<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Add this line
            $table->unsignedBigInteger('product_id'); // Add this line
            $table->string('uid')->unique();
            $table->integer('quantity');
            $table->decimal('price', 12, 2);
            $table->enum('status', ['new', 'processing', 'cancelled', 'sucess'])->default('new');
            $table->timestamps();

            // Define foreign key constraints after columns are created
            $table->foreign('customer_id')->references('id')->on('shop_customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('shop_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
