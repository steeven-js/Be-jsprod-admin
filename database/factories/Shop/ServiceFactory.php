<?php

namespace Database\Factories\Shop;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop\Service;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->catchPhrase(),
            'slug' => Str::slug($name),
            'is_visible' => $this->faker->boolean(),
            'license' => $this->faker->randomElement(['Standard', 'Plus', 'Extended']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'priceSale' => $this->faker->randomFloat(2, 40, 450),
            'caption' => $this->faker->sentence(),
            'ratingNumber' => $this->faker->randomFloat(1, 1, 5),
            'totalReviews' => $this->faker->numberBetween(1, 40),
            'description' => $this->faker->realText(),
            'quantity' => $this->faker->numberBetween(1, 20),
            'commons' => [
                ['title' => 'One end products', 'disabled' => true],
                ['title' => '12 months updates', 'disabled' => true],
                ['title' => '6 months of support', 'disabled' => true],
            ],
            'options' => [
                ['title' => 'JavaScript version', 'disabled' => false],
                ['title' => 'TypeScript version', 'disabled' => true],
                ['title' => 'Design resources', 'disabled' => true],
                ['title' => 'Commercial applications', 'disabled' => true],
            ],
            'specifications' => [
                ['label' => 'Category', 'value' => 'Mobile'],
                ['label' => 'Manufacturer', 'value' => 'Apple'],
                ['label' => 'Warranty', 'value' => '12 Months'],
                ['label' => 'Serial number', 'value' => '358607726380311'],
                ['label' => 'Ships From', 'value' => 'United States'],
            ],
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
