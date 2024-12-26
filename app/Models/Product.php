<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'weight',
    ];

    /**
     * Define the relationship with Category.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define the relationship with ProductSize.
     *
     * @return HasMany
     */
    public function productSizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    /**
     * Define the relationship with ProductImage.
     *
     * @return HasMany
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
