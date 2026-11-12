<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasSlug;

    protected $fillable = [
        'code',
        'slug',
        'names',
        'category_id',
        'location_id',
        'condition_id',
        'stock',
        'units',
        'min_stock',
        'descriptions',
    ];

    protected $casts = [
        'stock' => 'integer',
        'min_stock' => 'integer'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(Condition::class);
    }

    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }

    public function stockOuts(): HasMany
    {
        return $this->hasMany(StockOut::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(InventoryHistory::class);
    }
}
