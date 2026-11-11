<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockIn extends Model
{
    use HasSlug;

    protected $fillable = [
        'referemce',
        'item_id',
        'quantity',
        'date',
        'source',
        'note',
        'user_id'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'date' => 'date',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
