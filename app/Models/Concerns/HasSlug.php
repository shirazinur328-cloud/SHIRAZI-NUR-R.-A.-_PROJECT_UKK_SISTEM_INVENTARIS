<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function ($model) {
            $base = Str::slug($model->name);
            $slug = $base;
            $counter = 2;

            while (static::where('slug', $slug)->where('id', '!=', $model->id)->exists()) {
                $slug = $base . '-' . $counter++;
            }
    
            $model->slug = $slug;
        });
    }
}