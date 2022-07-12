<?php

namespace App\Models;

use App\Models\Traits\PositionSortedTrait;
use App\Models\Traits\VisibleTrait;
use App\Models\Traits\WithTranslationsTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Translatable;
    use VisibleTrait;
    use WithTranslationsTrait;
    use PositionSortedTrait;

    public  $translatedAttributes = [
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected $fillable = [
        'owner_id',
        'title',
        'description',
    ];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function pools(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pool::class);
    }
}
