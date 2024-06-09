<?php

namespace Database\Factories\Shop;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // $table->string('name');
            // $table->string('slug')->unique();
            // $table->boolean('is_visible')->default(false);
            // $table->decimal('price', 6, 2)->nullable();
            // $table->decimal('priceSale', 6, 2)->nullable();
            // $table->string('caption')->nullable();
            // $table->decimal('ratingNumber', 2, 1)->nullable();
            // $table->integer('totalReviews')->nullable();
            // $table->text('description')->nullable();
            // $table->integer('quantity')->nullable();
            // $table->json('specifications')->nullable();
            // $table->date('published_at')->nullable();

            'name' => $name = $this->faker->unique()->catchPhrase(),
            'slug' => Str::slug($name),
            'is_visible' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'priceSale' => $this->faker->randomFloat(2, 40, 450),
            'caption' => $this->faker->sentence(),
            'ratingNumber' => $this->faker->randomFloat(1, 1, 5),
            'totalReviews' => $this->faker->numberBetween(1, 40),
            'description' => $this->faker->realText(),
            'quantity' => $this->faker->numberBetween(1, 20),
            'specifications' => [
                'weight' => $this->faker->randomFloat(2, 0.1, 10),
                'height' => $this->faker->randomFloat(2, 0.1, 10),
                'width' => $this->faker->randomFloat(2, 0.1, 10),
                'depth' => $this->faker->randomFloat(2, 0.1, 10),
            ],
        ];
    }
}
