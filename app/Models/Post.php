<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    //protected $primaryKey = "id";

    protected $with = ["author"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'publication_date'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'title',
        'description',
        'publication_date',
        'slug'
    ];

    /**
     * Set the proper slug attribute
     * @param string $value
     */
    public function setSlugAttribute($value){
        if (static::whereSlug($slug = Str::slug($value, '-'))->exists()) {
            $slug = "{$slug}-".get_slug_uuid();
        }
        $this->attributes['slug'] = $slug;
    }

    /**
     * Return the post's author
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope a query to order posts by latest/oldest posted
     * @param Builder $query
     * @param string|null $sort
     * @return Builder
     */
    public function scopeSorting(Builder $query, ?string $sort): Builder
    {
        return $query->orderBy('publication_date', empty($sort) ? "DESC": $sort);
    }


    /**
     * Scope a query to search posts
     * @param Builder $query
     * @param string|null $search
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $search) : ? Builder
    {
        if ($search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        }
        return null;
    }

    /**
     * Get only my posts
     * @param Builder $query
     * @param $userId
     * @return Builder
     */
    public function scopeMine(Builder $query, int $userId, bool $isAdmin = false): ?Builder
    {
        if(!$isAdmin) {
            return $query->where('author_id', $userId);
        }
        return null;
    }
}
