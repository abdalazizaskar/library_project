<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'isbn',
        'description',
        'cover_path',
        'published_year',
        'total_copies',
    ];

    protected function casts(): array
    {
        return [
            'published_year' => 'integer',
            'total_copies' => 'integer',
        ];
    }

    public function detail(): HasOne
    {
        return $this->hasOne(BookDetail::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function borrowers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'borrowings')
            ->withPivot('borrowed_at', 'due_date', 'returned_at', 'status')
            ->withTimestamps();
    }

    /**
     * How many copies are currently borrowed (not returned).
     */
    public function borrowedCopiesCount(): int
    {
        return $this->borrowings()
            ->whereIn('status', ['borrowed', 'overdue'])
            ->count();
    }

    /**
     * How many copies are still available for borrowing.
     */
    public function availableCopiesCount(): int
    {
        return max(0, (int) $this->total_copies - $this->borrowedCopiesCount());
    }

    /**
     * Average rating across all ratings (0 if none yet).
     */
    public function averageRating(): float
    {
        return (float) $this->ratings()->avg('rating') ?? 0.0;
    }
}
