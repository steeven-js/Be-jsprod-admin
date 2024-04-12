<?php

namespace App\Models\Blog;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'blog_authors';

    protected $fillable = [
        'name',
        'email',
        'bio',
        'github_handle',
        'twitter_handle',
    ];

    /** @return HasMany<Post> */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'blog_author_id');
    }

    // Média
    public function registerMediaCollections(): void
    {
        // You can customize the collection name and the disk as needed
        $this->addMediaCollection('author-avatar')->singleFile();
    }

    // URL de la première image
    public function getFirstMediaUrlAttribute()
    {
        return $this->getFirstMediaUrl('author-avatar');
    }
}
