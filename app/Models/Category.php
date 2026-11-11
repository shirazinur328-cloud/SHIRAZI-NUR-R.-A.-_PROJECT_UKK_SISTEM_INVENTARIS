<?php

namespace App\Models;

use app\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasSlug;

    protected $fillable = [
        'code',
        'slug',
        'name',
        'descrription',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
