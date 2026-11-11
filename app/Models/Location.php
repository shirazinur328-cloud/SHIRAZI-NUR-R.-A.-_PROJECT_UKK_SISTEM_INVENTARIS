<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasSlug;

    protected $fillable = [
        'code',
        'slug',
        'name',
        'description',
    ];

    public function itmes():HasMany
    {
        return $this->hasMany(Item::class);
    }
}
