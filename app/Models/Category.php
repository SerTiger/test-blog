<?php

namespace App\Models;

use App\Models\Traits\PositionSortedTrait;
use App\Models\Traits\VisibleTrait;
use App\Models\Traits\WithTranslationsTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    use VisibleTrait;
    use WithTranslationsTrait;
    use PositionSortedTrait;

    public  $translatedAttributes = [
        'title',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected $fillable = [
        'status',
        'position',
        'slug',
    ];

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function pools(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pool::class);
    }
}
