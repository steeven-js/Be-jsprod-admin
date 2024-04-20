<?php

namespace App\Models\Blog;

use App\Models\Comment;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements HasMedia
{
    use HasTags;
    use HasFactory;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'date',
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'duration',
        'description',
        'published_at',
        'blog_author_id',
        'blog_category_id',
    ];

    /** @return BelongsTo<Author,self> */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'blog_author_id');
    }

    /** @return BelongsTo<Category,self> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }

    /** @return MorphMany<Comment> */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Média
    public function registerMediaCollections(): void
    {
        // You can customize the collection name and the disk as needed
        $this->addMediaCollection('post-image')->singleFile();
    }

    // URL de la première image
    public function getFirstMediaUrlAttribute()
    {
        return $this->getFirstMediaUrl('post-images');
    }
}
