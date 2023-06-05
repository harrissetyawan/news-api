<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\News;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'action'
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
