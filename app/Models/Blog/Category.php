<?php

namespace App\Models\Blog;

use App\Models\Blog\Study;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'blog_categories';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    /** @return HasMany<Post> */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'blog_category_id');
    }

    /** @return HasMany<Study> */
    public function studies(): HasMany
    {
        return $this->hasMany(Study::class, 'blog_category_id');
    }
}
