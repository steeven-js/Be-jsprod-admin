<?php

namespace App\Models\Shop;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'shop_services';

    protected $fillable = [
        'name',
        'price',
        'priceSale',
        'caption',
        'ratingNumber',
        'totalReviews',
        'description',
        'quantity',
        'image',
        'specifications',
        'published_at',
    ];

    protected $casts = [
        'specifications' => 'array',
    ];

    // Define the media relationship
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('service-images')
            ->useFallbackUrl('https://placeholder.co/300x300');
    }

    public function getRatingAttribute(): string
    {
        return str_repeat('⭐', $this->ratingNumber);
    }

    public function getRatingNumberAttribute(): string
    {
        return number_format($this->ratingNumber, 1);
    }
}
