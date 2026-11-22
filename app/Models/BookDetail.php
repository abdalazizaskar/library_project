<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookDetail extends Model
{
    protected $fillable = [
        'book_id',
        'pages_count',
        'language',
        'publisher',
        'summary',
    ];

    protected function casts(): array
    {
        return [
            'pages_count' => 'integer',
        ];
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
