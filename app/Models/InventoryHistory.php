<?php

namespace App\Models;

use app\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryHistory extends Model
{
    use HasSlug;

    protected $fillable = [
        'item_id',
        'type',
        'quantity'
    ];
}
