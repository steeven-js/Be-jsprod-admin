<?php

namespace Database\Seeders;

use Closure;
use App\Models\User;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Blog\Link;
use App\Models\Blog\Post;
use App\Models\Shop\Brand;
use App\Models\Shop\Order;
use App\Models\Blog\Author;
use App\Models\Shop\Payment;
use App\Models\Shop\Product;
use App\Models\Blog\Category;
use App\Models\Shop\Customer;
use App\Models\Shop\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Illuminate\Database\Query\Expression;
use Filament\Notifications\Actions\Action;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Blog\Category as BlogCategory;
use App\Models\Shop\Category as ShopCategory;
use App\Filament\Resources\Shop\OrderResource;
use Symfony\Component\Console\Helper\ProgressBar;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::raw('SET time_zone=\'+00:00\'');

        // Clear images
        Storage::deleteDirectory('public');

        User::factory(5)->create();

        // Admin
        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin Test',
            'email' => 'kisama972@gmail.com',
        ]));
        $this->command->info('Admin user created.');

        // Shop
        $this->command->warn(PHP_EOL . 'Creating shop customers...');
        $customers = $this->withProgressBar(20, fn () => Customer::factory(1)
            ->create());
        $this->command->info('Shop customers created.');

        // Blog

        // Categories
        $blogCategories = [
            [
                'id' => 1,
                'name' => 'Technology',
            ],
            [
                'id' => 2,
                'name' => 'Marketing',
            ],
            [
                'id' => 3,
                'name' => 'Design',
            ],
            [
                'id' => 4,
                'name' => 'Photography',
            ],
            [
                'id' => 5,
                'name' => 'Art',
            ],
            [
                'id' => 6,
                'name' => 'Fashion',
            ],
        ];

        $this->command->warn(PHP_EOL . 'Creating blog categories...');

        $categoriesCollection = collect($blogCategories);

        foreach ($blogCategories as $category) {
            Category::factory()->create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => 'Description for ' . $category['name'],
                'is_visible' => true,
            ]);
        }

        $this->command->info('Blog categories created.');

        $this->command->warn(PHP_EOL . 'Creating blog authors and posts...');
        $this->withProgressBar(20, fn () => Author::factory(1)
            ->has(
                Post::factory()->count(5)
                    ->has(
                        Comment::factory()->count(rand(5, 10))
                            ->state(function (array $attributes, Post $post) use ($categoriesCollection) {
                                return ['customer_id' => Customer::inRandomOrder()->first()->id];
                            }),
                    )
                    ->state(function (array $attributes, Author $author) use ($categoriesCollection) {
                        return ['blog_category_id' => $categoriesCollection->random()['id']];
                    }),
                'posts'
            )
            ->create());
        $this->command->info('Blog authors and posts created.');

        $this->command->warn(PHP_EOL . 'Creating blog links...');
        $this->withProgressBar(20, fn () => Link::factory(1)
            ->count(20)
            ->create());
        $this->command->info('Blog links created.');
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection();

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
